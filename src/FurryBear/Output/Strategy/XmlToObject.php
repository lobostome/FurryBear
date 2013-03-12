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

use FurryBear\Exception\InvalidXmlException,
    FurryBear\Output\Strategy;

/**
 * Converts the xml string returned from the service to an object.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class XmlToObject implements Strategy
{
    /**
     * Convert the xml data to an object.
     * 
     * @param string $data The xml string returned from the service.
     * 
     * @return object
     * @throws \FurryBear\Exception\InvalidJsonException
     */
    public function convert($data)
    {
        libxml_use_internal_errors(true);
        $obj = simplexml_load_string($data);
        
        if ($obj === false) {
            $errors = '';
            foreach (libxml_get_errors() as $error) {
                $errors .= ';';
            }
            throw new InvalidXmlException('Invalid xml');
        } else {
            return $obj;
        }
    }
}