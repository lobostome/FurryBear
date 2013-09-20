<?php

require_once 'config/config_di.php';

use FurryBear\FurryBearContainer;

$container = new FurryBearContainer();
$container['apikey'] = $apiKey;
$searchCriteria = array('query' => '"health care" medicine');

var_dump($container->getServices());
var_dump($container['furrybear']->bills_search->get($searchCriteria));