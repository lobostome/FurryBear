<?php

require_once '../SplClassLoader.php';

$classLoader = new SplClassLoader(__DIR__ . '/../../src');
$classLoader->register();

// Substitute $apiKey with your API key.
$apikeyFile = __DIR__ . '/keys/apikey-sf.local';
$apiKey = (file_exists($apikeyFile)) 
                    ? file_get_contents($apikeyFile) 
                    : 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';

/**
 * FurryBear\Http\Adapter\Curl
 * FurryBear\Http\Adapter\Buzz
 * FurryBear\Http\Adapter\Guzzle
 */
$adapter    = new FurryBear\Http\Adapter\Curl();
$provider   = new FurryBear\Provider\Source\SunlightOpenStates($adapter, $apiKey);
$output     = new FurryBear\Output\Strategy\JsonToArray();

$fb = new FurryBear\FurryBear();
$fb->registerProvider($provider)
   ->registerOutput($output);