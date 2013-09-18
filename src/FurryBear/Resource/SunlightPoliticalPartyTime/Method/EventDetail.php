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

namespace FurryBear\Resource\SunlightPoliticalPartyTime\Method;

use FurryBear\Resource\SunlightPoliticalPartyTime\BaseResource;

/**
 * This class gives access to Sunlight Political Party Time events detail resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class EventDetail extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'event';

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
     * Sets the id of the event.
     * 
     * @param int $id The event id.
     * 
     * @return \FurryBear\Resource\SunlightPoliticalPartyTime\Method\EventDetail
     */
    public function id($id) {
        $this->setResourceMethod(sprintf("%s/%d", self::ENDPOINT_METHOD, $id));
        return $this;
    } 
}