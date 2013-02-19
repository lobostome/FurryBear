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

namespace FurryBear\View;

/**
 * Converts the json string returned from the service to an array.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class JsonToArrayViewStrategy implements ViewStrategy
{
    /**
     * Convert the json data to an associative array.
     * 
     * @param string $data The json string returned from the service.
     * 
     * @return array
     */
    public function output($data)
    {
        return json_decode($data, true);
    }
}