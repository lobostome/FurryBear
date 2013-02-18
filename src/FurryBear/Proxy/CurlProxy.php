<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */
namespace FurryBear\Proxy;
/**
 * A proxy that provides a surrogate for curl.
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 */
class CurlProxy implements HttpRequest {
    
    /**
     * A connection handle.
     * 
     * @var resource
     */
    private $handle = null;
    
    /**
     * Initialize a connection session.
     * 
     * @param string $url
     */
    public function __construct($url) {
        $this->handle = curl_init($url);
    }
    
    /**
     * {@inheritdoc}
     */
    public function close() {
        curl_close($this->handle);
    }

    /**
     * {@inheritdoc}
     * 
     * @return mixed
     */
    public function execute() {
        return curl_exec($this->handle);
    }

    /**
     * {@inheritdoc}
     * 
     * @param int $name
     * @return mixed
     */
    public function getInfo($name) {
        return curl_getinfo($this->handle, $name);
    }

    /**
     * {@inheritdoc}
     * 
     * @param int $name
     * @param mixed $value
     */
    public function setOption($name, $value) {
        curl_setopt($this->handle, $name, $value);
    }
}