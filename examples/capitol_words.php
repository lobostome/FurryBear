<?php

require_once 'config/config_capitol_words.php';

$params1 = array('phrase' => 'united states',
                 'start_date' => '2009-01-01',
                 'end_date' => '2009-04-30',
                 'granularity' => 'month');

// A sample use
try {
    $fb->dates->setParams($params1);
    var_dump($fb->dates->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}