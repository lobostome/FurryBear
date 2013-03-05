<?php

/**
 * FurryBear
 * 
 * PHP Version 5.3
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
namespace FurryBear\Http;

/**
 * The http connection interface for the adapter pattern.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
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
    public function setHeaders(array $headers = array());
}