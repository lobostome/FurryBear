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

namespace FurryBear\Resource\SunlightCongress\Method;

use FurryBear\Resource\SunlightCongress\BaseResource;

/**
 * This class gives access to Sunlight Congress legislators resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class Legislators extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'legislators';

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
     * Gets legislators whose term starts on $date.
     * 
     * @param mixed $date
     * 
     * @return array
     */
    public function getTermStart($date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        }
        
        $params = array('term_start' => $date);
        return $this->get($params);
    }
    
    /**
     * Gets legislators whose term ends on $date.
     * 
     * @param mixed $date
     * 
     * @return array
     */
    public function getTermEnd($date = null)
    {
        if (is_null($date)) {
            $date = date('Y-m-d');
        }
        
        $params = array('term_end' => $date);
        return $this->get($params);
    }
}