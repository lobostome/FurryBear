<?php

require_once '../SplClassLoader.php';

$classLoader = new SplClassLoader(__DIR__ . '/../src');
$classLoader->register();

// Substitute with your API key.
$apiKey = 'xxxxx';