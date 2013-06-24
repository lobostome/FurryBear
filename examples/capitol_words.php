<?php

require_once 'config/config_capitol_words.php';

$params = array('phrase'    => 'health care debate',
                'party'     => 'R');

// A sample use
try {
    $fb->text->setParams($params);
    var_dump($fb->text->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}