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
 * Converts the json string returned from the service to an array.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class JsonToArray implements Strategy
{
    /**
     * Convert the json data to an associative array.
     * 
     * @param string $data The json string returned from the service.
     * 
     * @return array
     * @throws InvalidJsonException
     */
    public function convert($data)
    {
        $array = json_decode($data, true);
        
        if (json_last_error() == JSON_ERROR_NONE) {
            return $array;
        } else {
            throw new InvalidJsonException('JsonToArray Output Strategy Report: Invalid json');
        }
    }
}