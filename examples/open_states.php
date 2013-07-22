<?php

require_once 'config/config_open_states.php';

try {
    $fb->bill_detail->criteria('ca', '20092010', 'AB 667');
    
    var_dump($fb->bill_detail->get());
    
} catch (\Exception $e) {
    echo $e->getMessage();
}