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
namespace FurryBear\Proxy;
/**
 * An interface for a general http request.
 * 
 * @package     FurryBear
 * @author      lobostome <lobostome@local.dev>
 * @license     http://opensource.org/licenses/MIT
 * @link        https://github.com/lobostome/FurryBear
 * @category    Congress API
 */
interface HttpRequest
{
    /**
     * Close a connection session.
     * 
     * @return void
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
     * @param int $name The return key constant.
     * 
     * @return mixed
     */
    public function getInfo($name);
    
    /**
     * Set an option for a connection transfer.
     * 
     * @param int   $name   The CURLOPT_XXX option to set.
     * @param mixed $value  The value to be set on option.
     * 
     * @return void
     */
    public function setOption($name, $value);
}