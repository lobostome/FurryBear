<?php

/**
 * FurryBear
 * 
 * PHP Version 5
 * 
 * @package     FurryBear
 * @author      lobostome <lobostome@local.dev>
 * @license     http://opensource.org/licenses/MIT
 * @link        https://github.com/lobostome/FurryBear
 * @category    Congress API
 */
namespace FurryBear\HttpAdapter;

/**
 * The http connection interface for the adapter pattern.
 * 
 * @package     FurryBear
 * @author      lobostome <lobostome@local.dev>
 * @license     http://opensource.org/licenses/MIT
 * @link        https://github.com/lobostome/FurryBear
 * @category    Congress API
 */
interface HttpAdapterInterface
{
    /**
     * Fetches the content from a URL.
     * 
     * @param string $url The target URI location.
     * 
     * @return string
     */
    public function getContent($url);
    
    /**
     * Sets the contents of the "User-Agent: " header.
     * 
     * @param string $userAgent A custom user agent.
     * 
     * @return void
     */
    public function setUserAgent($userAgent);
    
    /**
     * Sets an array of HTTP header fields.
     * 
     * @param array $headers An array of custom HTTP headers.
     * 
     * @return void
     */
    public function setHeaders($headers);
}