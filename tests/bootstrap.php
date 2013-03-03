<?php

require_once __DIR__ . '/../SplClassLoader.php';

$classLoader = new SplClassLoader(__DIR__ . '/../src');
$classLoader->register();