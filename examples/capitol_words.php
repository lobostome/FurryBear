<?php

require_once 'config/config_capitol_words.php';

$params = array('entity_type'   => 'legislator',
                'entity_value'  => 'L000551');

// A sample use
try {
    $fb->phrases->setParams($params);
    var_dump($fb->phrases->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}