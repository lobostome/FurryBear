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

namespace FurryBear\Resource\SunlightOpenStates\Method;

use FurryBear\Resource\SunlightOpenStates\BaseResource,
    FurryBear\Common\Exception\NotImplementedException;

/**
 * This class gives access to Sunlight Open States districts resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class Districts extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'districts';

    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL.
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod(self::ENDPOINT_METHOD);
    }
    
    /**
     * Sets the criateria parameters. Creates an alias of setCriteria() called 
     * criteria().
     * 
     * @param string $name      The method name.
     * @param string $arguments The method arguments.
     * 
     * @return \FurryBear\Resource\SunlightOpenStates\Method\Districts
     * 
     * @throws NotImplementedException
     * @throws InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        if ($name !== 'criteria' && $name !== 'setCriteria') {
            $message = sprintf("The method '%s' is not supported", $name);
            throw new NotImplementedException($message);
        }
        
        if (count($arguments) == 1) {
            $this->setResourceMethod(sprintf("%s/%s", self::ENDPOINT_METHOD, $arguments[0]));
        } else if (count($arguments) == 2) {
            $this->setResourceMethod(sprintf("%s/%s/%s", self::ENDPOINT_METHOD, $arguments[0], $arguments[1]));
        } else {
            $message = sprintf("Invalid number of arguments for criteria method. 
                                Pass state as the first argument, and optionaly 
                                chamber as the second.");
            throw new InvalidArgumentException($message);
        }
        
        return $this;
    }
}