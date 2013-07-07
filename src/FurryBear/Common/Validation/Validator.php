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

namespace FurryBear\Common\Validation;

/**
 * A base class for validators
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class Validator
{
    /**
     * Available validator options.
     * 
     * @var array
     */
    protected $options;
    
    /**
     * The value to validate.
     * 
     * @var mixed
     */
    protected $value;
    
    /**
     * Create a validator with specific options.
     * 
     * @param array $options
     */
    public function __construct(array $options = array())
    {
        $this->options = $options;
    }
    
    /**
     * Checks if an option is set.
     * 
     * @param string $key
     * 
     * @return boolean
     */
    public function issetOption($key)
    {
        return array_key_exists($key, $this->options);
    }
    
    /**
     * Get an option based on a key.
     * 
     * @param string $key The option key
     * 
     * @return mixed
     */
    public function getOption($key)
    {
        return $this->options[$key];
    }
    
    /**
     * Set an option.
     * 
     * @param string $key
     * @param mixed  $value
     * 
     * @return void
     */
    public function setOption($key, $value)
    {
        $this->options[$key] = $value;
    }
    
    /**
     * Sets the value to validate.
     * 
     * @param type $value
     * 
     * @return void
     */
    public function setValue($value)
    {
        $this->value = $value;
    }
    
    /**
     * Gets the value to validate
     * 
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }
}