<?php

require_once 'config/config_ppt.php';

try {
    
    var_dump($fb->host_detail->id(1)->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}