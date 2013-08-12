<?php

require_once 'config/config_curl.php';

$zip = '94102';
$address = '2130 Fulton Street, San Francisco, CA 94117';

try {
    
    $googleMaps = new \FurryBear\Geocode\Provider\GoogleMaps();
    $bingMapsApiKey = (file_exists(__DIR__ . '/config/keys/apikey-bingmaps.local')) 
                            ? file_get_contents(__DIR__ . '/config/keys/apikey-bingmaps.local') 
                            : 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';
    
    $bingMaps = new \FurryBear\Geocode\Provider\BingMaps($bingMapsApiKey);
    
    $chain = new FurryBear\Geocode\Provider\Chain(array($bingMaps, $googleMaps));
    
    var_dump($fb->legislators_locate->via($chain)
                                    ->getByAddress($address));
} catch (\Exception $e) {
    echo $e->getMessage();
}