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

try {

    $fb->floor_updates->setParams($params);
    $it = $fb->floor_updates->getIterator();
    while($it->valid()) {
        var_dump($it->current());
        $it->next(); // How ugly that is..., but necessary
    }
} catch (\FurryBear\Exception\NoProviderException $e) {
    echo $e->getMessage();
} catch (\FurryBear\Exception\NoOutputException $e) {
    echo $e->getMessage();
} catch (\FurryBear\Exception\NoResultException $e) {
    echo $e->getMessage();
} catch (\FurryBear\Exception\FileDoesNotExistException $e) {
    echo $e->getMessage();
}