<?php

require_once 'config/config_capitol_words.php';

$params1 = array('phrase' => 'free market',
                'sort' => 'count');

$params2 = array('entity_type' => 'legislator',
                 'entity_value' => 'L000551');

// A sample use
try {
    $fb->phrases->entity('legislator')->setParams($params1);
    var_dump($fb->phrases->get());
    
    $fb->phrases->entity()->setParams($params2);
    var_dump($fb->phrases->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}