<?php

require_once 'config/config_capitol_words.php';

$params = array('phrase'        => 'united states',
                'entity_type'   => 'state',
                'entity_value'  => 'VA');

// A sample use
try {
    $fb->dates->setParams($params);
    var_dump($fb->dates->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}