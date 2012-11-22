# SilverStripe Geocoder

Convert ip addresses to 

## Requirements

 * php 5.3
 * Sapphire 2.4+
 
## Usage

```
	$ip = Controller::curr()->getRequest()->getIP();
	$geodata = SS_Geocoder::geocode($ip);
```
