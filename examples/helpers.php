<?php

require_once 'config/config_curl.php';

$zip = '94102';
$address = '2130 Fulton Street, San Francisco, CA 94117';

try {
    var_dump($fb->legislators_locate->getByZip($zip));
    
    $geocodeProvider = new \FurryBear\Geocode\Provider\GoogleMaps();
    
    var_dump($fb->legislators_locate->via($geocodeProvider)
                                    ->getByAddress($address));
    
} catch (\Exception $e) {
    echo $e->getMessage();
}