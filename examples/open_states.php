<?php

require_once 'config/config_open_states.php';

try {
    var_dump($fb->metadata_state->tx->get());
    var_dump($fb->metadata_state->ca->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}