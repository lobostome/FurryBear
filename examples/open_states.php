<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->event_detail->id('TXE00026474')->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}