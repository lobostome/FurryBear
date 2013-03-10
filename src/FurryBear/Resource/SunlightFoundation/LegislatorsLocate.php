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

namespace FurryBear\Resource\SunlightFoundation;

/**
 * This class gives access to Sunlight Congress legislators/locate resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class LegislatorsLocate extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const LEGISLATORS_LOCATE_METHOD = 'legislators/locate';

    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL.
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod(self::LEGISLATORS_LOCATE_METHOD);
    }
    
    /**
     * Retrieves legislators based on a zip
     * 
     * @param string $zip
     * 
     * @return mixed
     */
    public function getByZip($zip)
    {
        $params = array('zip' => (string)$zip);
        return $this->get($params);
    }
}