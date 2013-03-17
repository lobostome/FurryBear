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

namespace FurryBear\Output\Strategy\Error;
/**
 * Converts an xml error to a more readable format
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class Xml
{
    /**
     * An array of LibXMLError objects
     * 
     * @var array 
     */
    protected $errors;
    
    /**
     * Construct an object with an array of LibXMLError objects
     * 
     * @param array $errors An array of LibXMLError objects
     */
    public function __construct($errors)
    {
        $this->errors = $errors;
        libxml_clear_errors();
    }
    
    /**
     * Convert the array of errors into a string
     * 
     * @return string
     */
    public function __toString()
    {
        $return = PHP_EOL . PHP_EOL;
        foreach ($this->errors as $error) {
            switch ($error->level) {
                case LIBXML_ERR_WARNING:
                    $return .= "Warning $error->code: ";
                    break;
                 case LIBXML_ERR_ERROR:
                    $return .= "Error $error->code: ";
                    break;
                case LIBXML_ERR_FATAL:
                    $return .= "Fatal Error $error->code: ";
                    break;
            }
            
            $return .= trim($error->message) . PHP_EOL .
                            "  Line: $error->line" . PHP_EOL .
                            "  Column: $error->column" . PHP_EOL . PHP_EOL;
        }
        
        return $return;
    }
}
