<?php

require_once '../SplClassLoader.php';

$classLoader = new SplClassLoader(__DIR__ . '/../src');
$classLoader->register();

// Substitute with your API key.
$apiKey = 'xxxxx';

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

try {
    var_dump($fb->bills->get($params));
} catch (\FurryBear\Exception\NoResultException $e) {
    echo $e->getMessage();
}

// OR use an iterator
/*
try {

    $fb->bills->setParams($params);
    $it = $fb->bills->getIterator();
    $i = 0;
    while($it->valid()) {
        $i++;
        var_dump($it->current());
        $it->next();

        if($i == 2) break;
    }
} catch (\FurryBear\Exception\NoResultException $e) {
    echo $e->getMessage();
}
 * 
 */