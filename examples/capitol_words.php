<?php

require_once 'config/config_capitol_words.php';

$params1 = array('phrase' => 'free market');
$params2 = array('entity_type' => 'legislator','entity_value' => 'L000551');

try {
    // Traverse entity
    $fb->phrases->entity('legislator')->setParams($params1);
    foreach ($fb->phrases as $page) {
        if (!is_null($page))
            var_dump($page);
        sleep(2);
    }
    
    // Traverse phrases
    $fb->phrases->entity()->setParams($params2);
     foreach ($fb->phrases as $page) {
         if (!is_null($page))
             var_dump($page);
         sleep(2);
     }
} catch (\Exception $e) {
    echo $e->getMessage();
}