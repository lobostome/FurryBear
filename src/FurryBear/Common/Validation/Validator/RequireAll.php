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

namespace FurryBear\Common\Validation\Validator;

use FurryBear\Common\Validation\Validator,
    FurryBear\Common\Validation\ValidatorInterface,
    FurryBear\Common\Exception\InvalidArgumentException;

/**
 * A validator that verifies a full match against all domain options.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class RequireAll extends Validator implements ValidatorInterface
{
    /**
     * The option requirement.
     * 
     * @var string 
     */
    protected $matchOption = 'domain';
    
    /**
     * Default fail message.
     * 
     * @var string 
     */
    protected $defaultMessage = "All domain option items are required";
    
    /**
     * Construct the validator with default options.
     * 
     * @param array $options
     * 
     * @throws InvalidArgumentException
     */
    public function __construct($options)
    {
        parent::__construct($options);
        
        if (!$this->issetOption('message')) {
            $this->setOption('message', $this->defaultMessage);
        }
        
        if (!$this->issetOption('domain')) {
            throw new InvalidArgumentException(
                    get_class($this) . " validator requires a " . $this->matchOption . " option.");
        }
    }

    /**
     * Performs validation.
     * 
     * @return boolean
     */
    public function validate()
    {
        if (count($this->getOption($this->matchOption)) != 0 && 
            (count(array_intersect_key($this->getValue(), array_flip($this->getOption($this->matchOption)))) != count($this->getOption($this->matchOption)))) {
            return FALSE;
        }
        
        return TRUE;
    }
}