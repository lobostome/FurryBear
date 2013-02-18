<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */
namespace FurryBear\HttpAdapter;

use FurryBear\Exception\HttpException,
    FurryBear\Proxy\CurlProxy;

/**
 * A HTTP adapter based on curl.
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 * @link http://curl.haxx.se/
 */

class CurlHttpAdapter implements HttpAdapterInterface {
    
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
     * @var \FurryBear\Proxy\CurlProxy 
     */
    protected $proxy = null;
    
    /**
     * Construct with an optional cURL object.
     * 
     * @param \FurryBear\Proxy\CurlProxy $proxy
     */
    public function __construct($proxy = null) {
        if(!is_null($proxy))
            $this->proxy = $proxy;
    }
    
    /**
     * {@inheritdoc}
     * 
     * @param string $url
     * @return string
     */
    public function getContent($url) {
        
        if(is_null($this->proxy))
            $this->proxy = new CurlProxy($url);
        
        $this->proxy->setOption(CURLOPT_RETURNTRANSFER, TRUE);
        $this->proxy->setOption(CURLOPT_VERBOSE, 1);
        $this->proxy->setOption(CURLOPT_FOLLOWLOCATION, 1);
        $this->proxy->setOption(CURLOPT_USERAGENT, $this->userAgent);
        if (!empty($this->headers))
            $this->proxy->setOption(CURLOPT_HTTPHEADER, $this->headers);

        $content = $this->proxy->execute();
        $info = $this->proxy->getInfo(CURLINFO_HTTP_CODE);
        $this->proxy->close();
        
        if($info === FALSE && $info != 200)
            throw new HttpException('HTTP code: ' . $info); 
        
        if($content === FALSE)
            $content = null;
        
        return $content;
    }

    /**
     * {@inheritdoc}
     * 
     * @param array $headers
     */
    public function setHeaders($headers) {
        $this->headers = $headers;
    }

    /**
     * {@inheritdoc}
     * 
     * @param string $userAgent
     */
    public function setUserAgent($userAgent) {
        $this->userAgent = $userAgent;
    }
}