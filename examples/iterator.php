<?php

require_once 'config/config_curl.php';

$params = array('query'     => 'committee of the whole',
                'chamber'   => 'house');

try {

    $fb->floor_updates->setParams($params);
    $it = $fb->floor_updates->getIterator();
    while($it->valid()) {
        var_dump($it->current());
        $it->next(); // How ugly that is..., but necessary
        sleep(5); // be nice to the API
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