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

use FurryBear\Common\Exception\InvalidXmlException,
    FurryBear\Output\Strategy,
    FurryBear\Output\Strategy\Error\Xml as XmlError;

libxml_use_internal_errors(true);

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
     * @return \SimpleXMLElement
     * @throws \FurryBear\Common\Exception\InvalidJsonException
     */
    public function convert($data)
    {
        $obj = simplexml_load_string($data);
        
        if (!$obj) {
            $errors = new XmlError(libxml_get_errors());
            throw new InvalidXmlException('XmlToObject Output Strategy: ' . $errors->__toString());
        } else {
            return $obj;
        }
    }
}