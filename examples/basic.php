<?php

require_once 'config/config_curl.php';

/**
 * 1. Full text search (query)
 * 2. Partial response (fields)
 * 3. Pagination (per_page, page)
 * 4. Highlighting (highlight)
 */
$params1 = array('query'           => '"health care" medicine',
                 'history.enacted' => true,
                 'fields'          => 'official_title,chamber,introduced_on,search',
                 'highlight'       => true,
                 'per_page'        => 25,
                 'page'            => 2);

/**
 * Filtering
 */
$params2 = array('last_name'    => 'Smith',
                 'fields'       => 'first_name,last_name,state,title',
                 'order'        => 'state__asc,first_name__asc');

// A sample use
try {
    // Use setParams() method
    $fb->bills_search->setParams($params1);
    var_dump($fb->bills_search->get());
    
    // Or directly pass params to get() method
    var_dump($fb->legislators->get($params2));
} catch (\Exception $e) {
    echo $e->getMessage();
}