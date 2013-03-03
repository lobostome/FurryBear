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
 * An interface for a general http request.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
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
     * @return array
     */
    public function getInfo();
    
    /**
     * Set an option for a connection transfer.
     * 
     * @param int   $name  The CURLOPT_XXX option to set.
     * @param mixed $value The value to be set on option.
     * 
     * @return void
     */
    public function setOption($name, $value);
    
    /**
     * Return a string containing the last error for the current session
     * 
     * @return string
     */
    public function getError();
}