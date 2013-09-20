<?php

require_once '../SplClassLoader.php';

$classLoader = new SplClassLoader(__DIR__ . '/../../src');
$classLoader->register();

// Substitute $apiKey with your API key.
$apikeyFile = __DIR__ . '/keys/apikey-sf.local';
$apiKey = (file_exists($apikeyFile)) 
                    ? file_get_contents($apikeyFile) 
                    : 'xxxxxxxxxxxxxxxxxxxxxxxxxxx';