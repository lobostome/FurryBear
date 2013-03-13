<?php

require_once 'config/config_curl.php';

try {
    $fb->bulk_data->setDirectory(__DIR__ . DIRECTORY_SEPARATOR . 'download')
                  ->downloadLegislatorSpreadsheet();
} catch (\Exception $e) {
    echo $e->getMessage();
}