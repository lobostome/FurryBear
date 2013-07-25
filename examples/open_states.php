<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->committees->get(array('state' => 'dc')));
    
} catch (\Exception $e) {
    echo $e->getMessage();
}