<?php

require_once 'config/config_ppt.php';

try {
    
    var_dump($fb->lawmakers->get(array('crp_id' => 'N00003675')));
    
} catch (\Exception $e) {
    echo $e->getMessage();
}