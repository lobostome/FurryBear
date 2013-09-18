<?php

require_once 'config/config_ppt.php';

try {
    
    var_dump($fb->event_detail->id(31)->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}