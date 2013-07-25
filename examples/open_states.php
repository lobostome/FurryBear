<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->events->get(array('state' => 'tx')));
    
} catch (\Exception $e) {
    echo $e->getMessage();
}