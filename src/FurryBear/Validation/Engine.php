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

namespace FurryBear\Validation;

use FurryBear\Message\Group as MessageGroup,
    FurryBear\Message\Message as ValidationMessage,
    FurryBear\Exception\InvalidArgumentException;

/**
 * Allows to validate data using validators
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class Engine
{
    /**
     * The data to be verified.
     * 
     * @var array 
     */
    protected $data = array();
    
    /**
     * A container for registered validators.
     * 
     * @var array 
     */
    protected $validators = array();
    
    /**
     * A container for a group of messages.
     * 
     * @var \FurryBear\Message\Group 
     */
    protected $messages;
    
    /**
     * Construct the engine and run init function if available.
     */
    public function __construct()
    {
        if (method_exists($this, 'init')) {
            $this->init();
        }
        
        $this->messages = new MessageGroup();
    }
    
    /**
     * Performs the validation.
     * 
     * @return boolean
     * 
     * @throws InvalidArgumentException
     */
    public function isValid()
    {        
        if (empty($this->validators)) {
            throw new InvalidArgumentException("There are no validators specified.");
        }
        
        if (empty($this->data)) {
            throw new InvalidArgumentException("There is no data to validate.");
        }
        
        foreach ($this->data as $key => $value) {
            if (isset($this->validators[$key])) {
                foreach ($this->validators[$key] as $validator) {
                    $validator->setValue($value);
                                        
                    if (!$validator->validate()) {
                        $this->messages[] = new ValidationMessage($validator->getOption('message'));
                    }
                }
            }
        }
        
        if (count($this->messages) > 0) {
            return FALSE;
        }
        
        return TRUE;
    }
    
    /**
     * Adds a validator to the container.
     * 
     * @param string                          $attribute
     * @param \FurryBear\Validation\Validator $validator
     */
    public function add($attribute, Validator $validator)
    {
        $this->validators[$attribute][] = $validator;
    }
    
    /**
     * Sets the data to be validated.
     * 
     * @param array $data
     * 
     * @return void
     */
    public function populate($data)
    {
        $this->data = $data;
    }
    
    /**
     * Gets failed validation messages.
     * 
     * @return \FurryBear\Message\Group
     */
    public function getMessages()
    {
        return $this->messages;
    }
}