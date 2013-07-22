<?php

require_once 'config/config_open_states.php';

try {
    // $fb->bills->filter('state', 'dc')->filter('q', 'taxi')->sort('first');
    $fb->bills->filter(array('state' => 'dc', 'q' => 'taxi'))->sort('first');
    
    var_dump($fb->bills->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}