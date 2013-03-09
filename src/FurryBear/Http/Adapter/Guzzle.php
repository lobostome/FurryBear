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
namespace FurryBear\Http\Adapter;

use FurryBear\Proxy\Guzzle as GuzzleProxy,
    FurryBear\Http\HttpAdapterInterface;

/**
 * A HTTP adapter based on Guzzle http client.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/guzzle/guzzle
 */

class Guzzle implements HttpAdapterInterface
{
    /**
     * The contents of the <code>"User-Agent: "</code> header to be used in a 
     * HTTP request.
     * 
     * @var string
     */
    protected $userAgent = 'FurryBear via Guzzle';
    
    /**
     * An array of HTTP header fields to set, in the format:
     * <code> 
     * array('Content-type: text/plain', 'Content-length: 100')
     * </code>
     * 
     * @var array
     */
    protected $headers = array();
    
    /**
     * A reference to a Guzzle proxy object.
     * 
     * @var \FurryBear\Proxy\Guzzle
     */
    protected $proxy = null;
    
    /**
     * Construct with an optional Guzzle proxy object.
     * 
     * @param \FurryBear\Proxy\Guzzle $proxy A Guzzle proxy object.
     */
    public function __construct($proxy = null)
    {
        if (!is_null($proxy)) {
            $this->proxy = $proxy;
        }
    }
    
    /**
     * {@inheritdoc}
     * 
     * @param string $url A URL of the resource.
     * 
     * @return string
     */
    public function getContent($url) 
    {
        if (is_null($this->proxy)) {
            $this->proxy = new GuzzleProxy();
        }
        
        $this->proxy->setUserAgent($this->userAgent);
        if (!empty($this->headers)) {
            $this->proxy->setHeaders($this->headers);
        }

        try {
            $this->proxy->setUrl($url);
            $response = $this->proxy->execute();
            $content  = $response->getBody();
        } catch (\Exception $e) {
            $this->proxy->getError();
        }
        
        return $content;
    }

    /**
     * {@inheritdoc}
     * 
     * @param array $headers An array of HTTP headers.
     * 
     * @return void
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * {@inheritdoc}
     * 
     * @param string $userAgent A custom user agent.
     * 
     * @return void
     */
    public function setUserAgent($userAgent) 
    {
        $this->userAgent = $userAgent;
    }
    
    /**
     * Clean up the Buzz proxy object
     */
    public function __destruct()
    {
        if (!is_null($this->proxy)) {
            $this->proxy = null;
        }
    }
}