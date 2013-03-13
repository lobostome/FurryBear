<?php

require_once 'config/config_curl.php';

try {
    var_dump(
            $fb->bills_search->fields('official_title', 'chamber', 'introduced_on', 'search')
                             ->search('"health care" medicine')
                             ->filter('history.enacted', true)
                             ->order('introduced_on')
                             ->order('bill_id', 'asc')
                             ->highlight('<strong>', '</strong>', 300)
                             ->page(2, 25)
                             ->explain()
                             ->get()
    );
} catch (\Exception $e) {
    echo $e->getMessage();
}