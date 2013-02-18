<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */
namespace FurryBear\Exception;

/**
 * A custom exception thrown when a HTTP error code occurs.
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 */

class HttpException extends \RuntimeException 
                    implements ExceptionInterface {
    
}