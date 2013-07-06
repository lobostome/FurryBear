<?php

require_once 'config/config_capitol_words.php';

$params1 = array('phrase' => 'legislator');

// A sample use
try {
    $fb->phrases->entity('state')->setParams($params1);
    var_dump($fb->phrases->get());
    
    $fb->phrases->entity()->setParams($params1);
    var_dump($fb->phrases->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}