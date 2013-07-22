<?php

require_once 'config/config_open_states.php';

try {
    var_dump($fb->metadata->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}