<?php

require_once 'config.php';

$params = array('query'     => 'committee of the whole',
                'chamber'   => 'house');

// The simpler foreach way.
try {
    $fb->floor_updates->setParams($params);
    foreach ($fb->floor_updates as $page) {
        var_dump($page);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}