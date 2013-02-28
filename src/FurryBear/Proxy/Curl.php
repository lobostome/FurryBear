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
/**
 * A proxy that provides a surrogate for curl.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://curl.haxx.se/
 */
class Curl implements HttpRequest
{
    /**
     * A connection handle.
     * 
     * @var resource
     */
    private $_handle = null;
    
    /**
     * Initialize a connection session.
     * 
     * @param string $url The target URI location.
     */
    public function __construct($url)
    {
        $this->_handle = curl_init($url);
    }
    
    /**
     * {@inheritdoc}
     * 
     * @return void
     */
    public function close()
    {
        curl_close($this->_handle);
    }

    /**
     * {@inheritdoc}
     * 
     * @return mixed
     */
    public function execute()
    {
        return curl_exec($this->_handle);
    }

    /**
     * {@inheritdoc}
     * 
     * @return array
     */
    public function getInfo()
    {
        return curl_getinfo($this->_handle);
    }

    /**
     * {@inheritdoc}
     * 
     * @param int   $name  The CURLOPT_XXX option to set.
     * @param mixed $value The value to be set on option.
     * 
     * @return void
     */
    public function setOption($name, $value)
    {
        curl_setopt($this->_handle, $name, $value);
    }
    
    /**
     * {@inheritdoc}
     * 
     * @return string
     */
    public function getError()
    {
        return 'cURL error code: ' . curl_errno($this->_handle) . '; error: ' . curl_error($this->_handle);
    }
}