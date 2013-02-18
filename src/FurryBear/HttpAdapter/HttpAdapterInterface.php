<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */
namespace FurryBear\HttpAdapter;

/**
 * The http connection interface for the adapter pattern.
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 */
interface HttpAdapterInterface {
    
    /**
     * Fetches the content from a URL.
     * 
     * @param string $url
     * @return string
     */
    public function getContent($url);
    
    /**
     * Sets the contents of the "User-Agent: " header.
     * 
     * @param string $userAgent
     */
    public function setUserAgent($userAgent);
    
    /**
     * Sets an array of HTTP header fields.
     * 
     * @param array $headers
     */
    public function setHeaders($headers);
}