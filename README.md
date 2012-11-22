# SilverStripe Geocoder

Convert ip addresses to geocoded data array.

Wrapps the Geocoder library. See: https://github.com/willdurand/Geocoder

## Requirements

 * php 5.3
 * sapphire 2.4+
 
## Configuration

Uses the FreeGeoIpProvider by default, but this can be changed in your
_config.php file:

``` php
	SS_Geocoder::$provider_class = 'MaxMindProvider';
```

For more providers, see the classes in this folder:
`/thirdparty/geocoder/src/Geocoder/Provider/`

## Usage

``` php
	$ip = Controller::curr()->getRequest()->getIP();
	$geodata = SS_Geocoder::geocode($ip);
	var_dump($geodata);
```

Outputs:

```
	array
	  'latitude' => float -36.8667
	  'longitude' => float 174.767
	  'city' => string 'Auckland' (length=8)
	  'region' => string 'Auckland' (length=8)
	  'regionCode' => string 'E7' (length=2)
	  'country' => string 'New Zealand' (length=11)
	  'countryCode' => string 'NZ' (length=2)
```

## Caveats

Note that geocoding won't work on development environments, ie localhost ip addresses.

Here are some ip addresses you can test:

 * 88.188.221.14
 * 68.145.37.34