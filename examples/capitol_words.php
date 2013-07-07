<?php

require_once 'config/config_capitol_words.php';

$params1 = array('phrase' => 'second chance act');

// A sample use
try {
    $fb->text->setParams($params1);
    //var_dump($fb->text->get());
    
    foreach ($fb->text as $page) {
        var_dump($page);
        sleep(2); // be nice to the API
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}