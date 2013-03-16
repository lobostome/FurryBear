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

namespace FurryBear\Output\Strategy;

use FurryBear\Exception\InvalidJsonException,
    FurryBear\Output\Strategy;

/**
 * Converts the json string returned from the service to an object.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class JsonToObject implements Strategy
{
    /**
     * Convert the json data to an object.
     * 
     * @param string $data The json string returned from the service.
     * 
     * @return object
     * @throws \FurryBear\Exception\InvalidJsonException
     */
    public function convert($data)
    {
        $obj = json_decode($data);
        
        if (json_last_error() == JSON_ERROR_NONE) {
            return $obj;
        } else {
            throw new InvalidJsonException('JsonToObject Output Strategy Report: Invalid json');
        }
    }
}