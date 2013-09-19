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

namespace FurryBear\Common\DI;

use FurryBear\Common\Exception\InvalidArgumentException;

/**
 * A dependency inject container.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class DI implements \ArrayAccess
{
    /**
     * An array that holds references to the DI elements.
     * 
     * @var array 
     */
    protected $container = array();
    
    /**
     * Creates a new DI with predefined values of available.
     * 
     * @param array $container
     */
    public function __construct(array $container = array())
    {
        $this->container = $container;
    }

    /**
     * Checks if the element exists by its key.
     * 
     * @param string $offset The unique key.
     * 
     * @return bool
     */
    public function offsetExists($offset)
    {
        return array_key_exists($offset, $this->container);
    }

    /**
     * Gets an element whether an object or a parameter. A new object is created 
     * every time. To get the same object, use shared() method.
     * 
     * @param string $offset The unique key of the element.
     * 
     * @return mixed
     * 
     * @throws InvalidArgumentException
     */
    public function offsetGet($offset)
    {
        if (!array_key_exists($offset, $this->container)) {
            throw new InvalidArgumentException(sprintf('Identifier "%s" does not exist.', $offset));
        }
        
        $isCallable = is_callable($this->container[$offset]);
        
        return $isCallable ? $this->container[$offset]($this) : $this->container[$offset];
    }

    /**
     * Creates a new element in the container.
     * 
     * @param string $offset A unique key.
     * @param mixed  $value  The value of the element.
     */
    public function offsetSet($offset, $value)
    {
        $this->container[$offset] = $value;
    }

    /**
     * Removes an element from the container.
     * 
     * @param string $offset The element key.
     */
    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }
    
    /**
     * Enforces same instance for all calls using a closure.
     * 
     * @param object $callable A service definition.
     * 
     * @return Closure Description
     * 
     * @throws InvalidArgumentException
     */
    public function shared($callable)
    {
        if (!is_callable($callable)) {
            throw new InvalidArgumentException('Invalid service call');
        }
        
        return function($di) use ($callable) {
            static $obj;
            
            if (is_null($obj)) {
                $obj = $callable($di);
            }
            
            return $obj;
        };
    }
}