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

use FurryBear\Common\Exception\NoResultException,
    FurryBear\Proxy\Curl as CurlProxy,
    FurryBear\Http\HttpAdapterInterface;

/**
 * A HTTP adapter based on curl.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://curl.haxx.se/
 */

class Curl implements HttpAdapterInterface
{
    /**
     * The contents of the <code>"User-Agent: "</code> header to be used in a 
     * HTTP request.
     * 
     * @var string
     */
    protected $userAgent = 'FurryBear via cURL';
    
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
     * A reference to a cURL proxy object.
     * 
     * @var \FurryBear\Proxy\Curl 
     */
    protected $proxy = null;
    
    /**
     * Construct with an optional cURL proxy object.
     * 
     * @param \FurryBear\Proxy\Curl $proxy A Curl proxy object.
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
            $this->proxy = new CurlProxy($url);
        }
        
        $this->proxy->setOption(CURLOPT_RETURNTRANSFER, true);
        $this->proxy->setOption(CURLOPT_USERAGENT, $this->userAgent);
        if (!empty($this->headers)) {
            $this->proxy->setOption(CURLOPT_HTTPHEADER, $this->headers);
        }

        $content = $this->proxy->execute();
        
        if ($content === false) {
            throw new NoResultException($this->proxy->getError());
        }
        
        $this->proxy->close();
        $this->proxy = null;
        
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
     * Clean up the cURL proxy object
     */
    public function __destruct()
    {
        if (!is_null($this->proxy)) {
            $this->proxy->close();
        }
        $this->proxy = null;
    }
}