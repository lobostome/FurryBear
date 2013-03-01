<?php

require_once 'config.php';

$adapter    = new \FurryBear\Http\Adapter\Curl();
$provider   = new \FurryBear\Provider\Source\SunlightFoundation($adapter, $apiKey);
$output     = new \FurryBear\Output\Strategy\JsonToArray();

$fb = new \FurryBear\FurryBear();
$fb->registerProvider($provider)
   ->registerOutput($output);

$params1 = array('query'           => '"health care" medicine',
                 'history.enacted' => true,
                 'highlight'       => true,
                 'per_page'        => 25,
                 'page'            => 2);

$params2 = array('last_name' => 'Smith');

$params3 = array('breakdown.total.Yea__gte' => 70,
                 'chamber'                  => 'senate');

// A sample use
try {
    // Use setParams() method
    $fb->bills_search->setParams($params1);
    var_dump($fb->bills_search->get());
    
    // Or directly pass params to get() method
    var_dump($fb->legislators->get($params2));
    
    var_dump($fb->votes->get($params3));
} catch (\Exception $e) {
    echo $e->getMessage();
}