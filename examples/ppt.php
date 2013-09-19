<?php

require_once 'config/config_ppt.php';

try {
    
    $fb->events->setParams(array('beneficiaries__state' => 'NM', 'limit' => 45));
    
    foreach ($fb->events as $page) {
        var_dump($page);
        sleep(2);
    }
    
} catch (\Exception $e) {
    echo $e->getMessage();
}