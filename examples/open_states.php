<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->districts->setCriteria('nc')->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}