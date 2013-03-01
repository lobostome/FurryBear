<?php

require_once 'config.php';

$adapter = new \FurryBear\Http\Adapter\Curl();
$provider = new \FurryBear\Provider\Source\SunlightFoundation($adapter, $apiKey);
$output = new \FurryBear\Output\Strategy\JsonToObject();

$fb = new \FurryBear\FurryBear();
$fb->registerProvider($provider)
   ->registerOutput($output);

$params = array("history.house_passage_result__exists" => true, 
                "chamber" => "house",
                "per_page" => 2,
                "page"  => 1);

// A sample use
try {
    $fb->bills->setParams($params);
    var_dump($fb->bills->get($params));
} catch (\FurryBear\Exception\NoProviderException $e) {
    echo $e->getMessage();
} catch (\FurryBear\Exception\NoOutputException $e) {
    echo $e->getMessage();
} catch (\FurryBear\Exception\NoResultException $e) {
    echo $e->getMessage();
}