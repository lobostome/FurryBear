<?php

require_once 'config/config_curl.php';

$zip = '94102';

try {
    var_dump($fb->legislators_locate->getByZip($zip));
} catch (\Exception $e) {
    echo $e->getMessage();
}