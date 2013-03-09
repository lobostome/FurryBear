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

namespace FurryBear\Proxy;

use FurryBear\Exception\NotImplementedException;

/**
 * A proxy that provides a surrogate for Guzzle http client.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/guzzle/guzzle
 */
class Guzzle implements HttpRequest
{
    /**
     * A connection handle.
     * 
     * @var \Guzzle\Service\Client
     */
    private $_handle = null;
    
    /**
     * A target URL.
     * 
     * @var string
     */
    private $_url;
    
    /**
     * The user agent
     * 
     * @var string
     */
    private $_userAgent;
    
    /**
     * The HTTP headers
     * 
     * @var array
     */
    private $_headers = array();
    
    /**
     * Initialize a connection session.
     */
    public function __construct()
    {
        $this->_handle = new \Guzzle\Service\Client();
    }
    
    /**
     * {@inheritdoc}
     * 
     * @throws FurryBear\Exception\NotImplementedException since this method is not used
     */
    public function close()
    {
        throw new NotImplementedException('Guzzle proxy does not implement a "' . __METHOD__ . '" method');
    }

    /**
     * {@inheritdoc}
     * 
     * @return \Guzzle\Http\Message\Response
     */
    public function execute()
    {
        $this->_handle->setUserAgent($this->_userAgent);
        return $this->_handle->get($this->_url, $this->_headers)->send();
    }

    /**
     * {@inheritdoc}
     * 
     * @throws FurryBear\Exception\NotImplementedException since this method is not used
     */
    public function getInfo()
    {
        throw new NotImplementedException('Guzzle proxy does not implement a "' . __METHOD__ . '" method');
    }

    /**
     * {@inheritdoc}
     * 
     * @param int   $name  The option to set.
     * @param mixed $value The value to be set to option.
     * 
     * @throws FurryBear\Exception\NotImplementedException since this method is not used
     */
    public function setOption($name, $value)
    {
        throw new NotImplementedException('Guzzle proxy does not implement a "' . __METHOD__ . '" method');
    }
    
    /**
     * {@inheritdoc}
     * 
     * @return string
     */
    public function getError()
    {
        return 'Guzzle error: ' . error_get_last();
    }
    
    /**
     * Set the target URL
     * 
     * @param string $url The target URL
     * 
     * @return void
     */
    public function setUrl($url)
    {
        $this->_url = $url;
    }
    
    /**
     * Set the HTTP headers
     * 
     * @param array $headers The HTTP headers
     * 
     * @return void
     */
    public function setHeaders(array $headers)
    {
        $this->_headers = $headers;
    }
    
    /**
     * Set the user agent
     * 
     * @param string $userAgent The user agent
     * 
     * @return void
     */
    public function setUserAgent($userAgent)
    {
        $this->_userAgent = $userAgent;
    }
}