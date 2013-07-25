<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->geo_lookup->coords(35.79, -78.78)->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}