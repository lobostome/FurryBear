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

namespace FurryBear\Message;

/**
 * Encapsulates verbose messages.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class Message
{
    /**
     * The message content.
     * 
     * @var string
     */
    protected $message;
    
    public function __construct($message)
    {
        $this->message = $message;
    }
    
    /**
     * Gets the message content.
     * 
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message content. 
     * 
     * @param string $message
     * 
     * @return void
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    /**
     * Object presentation as a string.
     * 
     * @return string
     */
    public function __toString()
    {
        return "[Message] " . $this->getMessage();
    }
}