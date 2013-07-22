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
    FurryBear\Common\Exception\InvalidArgumentException;

/**
 * This class gives access to Sunlight Open States bill detail resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class BillDetail extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'bills';

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
     * Overloads the criteria method. Sets the criteria for bill detail. 
     * Supports both url versions:
     * http://openstates.org/api/v1/bills/ca/20092010/AB%20667/
     * http://openstates.org/api/v1/bills/CAB00004148/
     * 
     * @param string $name     The name of the method.
     * @param array $arguments The arguments for the method.
     * 
     * @return \FurryBear\Resource\SunlightOpenStates\Method\BillDetail
     * 
     * @throws NotImplementedException
     * @throws InvalidArgumentException
     */
    public function __call($name, $arguments)
    {
        if ($name !== 'criteria') {
            $message = sprintf("The method '%s' is not supported", $name);
            throw new NotImplementedException($message);
        }
        
        if (count($arguments) == 1) {
            $this->setResourceMethod(sprintf("%s/%s", self::ENDPOINT_METHOD, $arguments[0]));
        } else if (count($arguments) == 3) {
            $this->setResourceMethod(sprintf("%s/%s/%s/%s", self::ENDPOINT_METHOD, 
                                                            $arguments[0],
                                                            $arguments[1],
                                                            rawurlencode($arguments[2])));
        } else {
            $message = sprintf("Invalid number of arguments for criteria method");
            throw new InvalidArgumentException($message);
        }
        
        return $this;
    }
}