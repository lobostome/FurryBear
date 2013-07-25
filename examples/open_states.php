<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->committee_detail->id('DCC000029')->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}