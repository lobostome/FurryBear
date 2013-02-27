<?php

require_once '../SplClassLoader.php';

$classLoader = new SplClassLoader(__DIR__ . '/../src');
$classLoader->register();

// Substitute with your API key.
$apiKey = 'xxxxx';

$adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter();
$provider = new \FurryBear\Provider\Source\SunlightFoundation($adapter, $apiKey);
$output = new \FurryBear\Output\Strategy\JsonToArray();

$fb = new \FurryBear\FurryBear();
$fb->registerProvider($provider)
   ->registerOutput($output);

$params = array("history.house_passage_result__exists" => true, 
                "chamber" => "house",
                "per_page" => 50,
                "explain" => "true");

var_dump($fb->bills->get($params));