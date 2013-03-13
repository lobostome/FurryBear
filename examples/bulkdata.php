<?php

require_once 'config/config_curl.php';

try {
    $fb->bulk_data->setDirectory(__DIR__ . DIRECTORY_SEPARATOR . 'download')
                  ->download('http://assets.sunlightfoundation.com/moc/40x50.zip');
} catch (\Exception $e) {
    echo $e->getMessage();
}