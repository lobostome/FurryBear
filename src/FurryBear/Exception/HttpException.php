<?php

/**
 * FurryBear
 * 
 * PHP Version 5
 * 
 * @package     FurryBear
 * @author      lobostome <lobostome@local.dev>
 * @license     http://opensource.org/licenses/MIT
 * @link        https://github.com/lobostome/FurryBear
 * @category    Congress API
 */
namespace FurryBear\Exception;

/**
 * A custom exception thrown when a HTTP error code occurs.
 * 
 * @package     FurryBear
 * @author      lobostome <lobostome@local.dev>
 * @license     http://opensource.org/licenses/MIT
 * @link        https://github.com/lobostome/FurryBear
 * @category    Congress API
 */

class HttpException extends \RuntimeException 
                    implements ExceptionInterface 
{
    
}