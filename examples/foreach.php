<?php

require_once 'config.php';

$adapter    = new \FurryBear\Http\Adapter\Curl();
$provider   = new \FurryBear\Provider\Source\SunlightFoundation($adapter, $apiKey);
$output     = new \FurryBear\Output\Strategy\JsonToObject();

$fb = new \FurryBear\FurryBear();
$fb->registerProvider($provider)
   ->registerOutput($output);

$params = array('query'     => 'committee of the whole',
                'chamber'   => 'house');

// The simpler foreach way.
try {
    $fb->floor_updates->setParams($params);
    foreach ($fb->floor_updates as $page) {
        var_dump($page);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}