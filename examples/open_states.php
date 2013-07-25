<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->legislators->get(array('state' => 'dc', 'chamber' => 'upper')));
    
} catch (\Exception $e) {
    echo $e->getMessage();
}