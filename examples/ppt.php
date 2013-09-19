<?php

require_once 'config/config_ppt.php';

try {
    
    var_dump($fb->lawmaker_detail->id(12)->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}