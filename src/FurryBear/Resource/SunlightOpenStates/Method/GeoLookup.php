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

use FurryBear\Resource\SunlightOpenStates\BaseResource;

/**
 * This class gives access to Sunlight Open States geo lookup resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class GeoLookup extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'legislators/geo';

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
     * Sets the geo coordinates for the look up. This is a helper function.
     * 
     * @param float $latitude  The latitude for the lookup.
     * @param float $longitude The longitude for the lookup.
     * 
     * @return \FurryBear\Resource\SunlightOpenStates\Method\GeoLookup
     */
    public function setCoords($latitude, $longitude)
    {
        $this->setParams(array('lat' => $latitude, 'long' => $longitude));
        return $this;
    }
    
    /**
     * Alias for setCoords function.
     * 
     * @return \FurryBear\Resource\SunlightOpenStates\Method\GeoLookup
     */
    public function coords()
    {
        $args = func_get_args();
        return call_user_func_array(array(__NAMESPACE__ . '\GeoLookup', 'setCoords'), $args);
    }
}