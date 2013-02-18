<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */
namespace FurryBear\Proxy;
/**
 * An interface for a general http request.
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 */
interface HttpRequest {
    /**
     * Close a connection session.
     */
    public function close();
    
    /**
     * Perform a connection session.
     * 
     * @return mixed
     */
    public function execute();
    
    /**
     * Get information regarding a specific transfer.
     * 
     * @param int $name
     * @return mixed
     */
    public function getInfo($name);
    
    /**
     * Set an option for a connection transfer.
     * 
     * @param int $name
     * @param mixed $value
     */
    public function setOption($name, $value);
}