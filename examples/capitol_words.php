<?php

require_once 'config/config_capitol_words.php';

$params1 = array('entity_type' => 'legislator',
                 'entity_value' => 'L000551'); // max 8 pages

// A sample use
try {
    $fb->phrases->setParams($params1);
    // var_dump($fb->phrases->get());
    
    foreach ($fb->phrases as $page) {
        if (!is_null($page))
            var_dump($page);
        sleep(2); // be nice to the API
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}