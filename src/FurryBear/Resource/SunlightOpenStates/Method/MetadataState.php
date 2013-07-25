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
 * This class gives access to Sunlight Open States metadata state resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class MetadataState extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'metadata';

    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL. Defaults to Alabama (picked alphabetically)
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod(sprintf("%s/%s", self::ENDPOINT_METHOD, 'al'));
    }
    
    /**
     * Defines the state for the metadata.
     * 
     * @param string $state The abbreviated state name.
     * 
     * @return \FurryBear\Resource\SunlightOpenStates\Method\MetadataState
     * 
     * @throws InvalidArgumentException
     */
    public function __get($state)
    {
        if (strlen($state) != 2 ) {
            $message = sprintf("The property needs to be a two letter abbreviation of a state. '%s' provided instead.", $state);
            throw new InvalidArgumentException($message);
        }
        
        $this->setResourceMethod(sprintf("%s/%s", self::ENDPOINT_METHOD, $state));
        
        return $this;
    }
}