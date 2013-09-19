<?php

require_once 'config/config_ppt.php';

try {
    
    var_dump($fb->hosts->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}