<?php
use Geocoder\Provider\FreeGeoIpProvider;
require_once __DIR__ .'/../thirdparty/geocoder/src/autoload.php';

/**
 * SilverStripe wrapper for Geocoder class.
 * 
 */
class SS_Geocoder{
	
	static $adapter_class = "CurlHttpAdapter";
	static $provider_class = "FreeGeoIpProvider"; //todo: allow setting multiple providers, for fallback
	
	protected $adapter, $geocoder;
		
	public function __construct(){
		$adapterclass = "\Geocoder\HttpAdapter\\".self::$adapter_class;
		$this->adapter  = new $adapterclass();
		$this->geocoder = new \Geocoder\Geocoder();
		$providerclass = "Geocoder\Provider\\".self::$provider_class;
		$this->geocoder->registerProvider(new $providerclass($this->adapter));
	}
	
	/**
	 * Returns an array of geocoded data.
	 * See Geocoder docs for more info
	 * @param string $ip
	 * @return array
	 */
	static function geocode($ip){
		return singleton('SS_Geocoder')->instance_geocode($ip);
	}
	
	static function ip_to_country_code($ip){
		$coded = self::geocode($ip);
		return isset($coded['countryCode']) && !empty($coded['countryCode']) ? $coded['countryCode'] : null;
	}
	
	function instance_geocode($ip){
		try{
			return $this->geocoder->geocode($ip)->toArray();
		}catch(Geocoder\Exception\NoResultException $e){
			//fail gracefully when response fails
			return array();
		}
	}
	
}