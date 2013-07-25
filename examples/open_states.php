<?php

require_once 'config/config_open_states.php';

try {
    
    var_dump($fb->legislator_detail->id('DCL000012')->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}