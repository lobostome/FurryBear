<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->district_boundary->id('sldl/nc-120')->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}