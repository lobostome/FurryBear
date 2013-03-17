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
class Json
{
    /**
     * Last json error
     * 
     * @var int 
     */
    protected $error;
    
    /**
     * Construct an object with the last json error
     * 
     * @param int $error Last json error
     */
    public function __construct($error)
    {
        $this->error = $error;
    }
    
    /**
     * Convert the json error to a more readable format
     * 
     * @return string
     */
    public function __toString()
    {
        $return = PHP_EOL;
        
        switch ($this->error) {
            case JSON_ERROR_DEPTH:
                $return .= 'Maximum stack depth exceeded';
            break;
            case JSON_ERROR_STATE_MISMATCH:
                $return .= 'Underflow or the modes mismatch';
            break;
            case JSON_ERROR_CTRL_CHAR:
                $return .= 'Unexpected control character found';
            break;
            case JSON_ERROR_SYNTAX:
                $return .= 'Syntax error, malformed JSON';
            break;
            case JSON_ERROR_UTF8:
                $return .= 'Malformed UTF-8 characters, possibly incorrectly encoded';
            break;
            default:
                $return .= 'Unknown error';
            break;
        }
        
        return PHP_EOL . $return;
    }
}
