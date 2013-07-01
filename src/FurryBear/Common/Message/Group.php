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

namespace FurryBear\Common\Message;

/**
 * Represents a group of validation messages
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class Group implements \Countable, \ArrayAccess, \Iterator
{
    /**
     * A container for the messages.
     * 
     * @var array
     */
    protected $messages = array();
    
    /**
     * Current container position.
     * 
     * @var int 
     */
    protected $position = 0;
    
    /**
     * Count elements of the object.
     * 
     * @return int
     */
    public function count()
    {
        return count($this->messages);
    }

    /**
     * Return the current element
     * 
     * @return \FurryBear\Message
     */
    public function current()
    {
        return $this->messages[$this->position];
    }

    /**
     * Returns the key of the current element.
     * 
     * @return int
     */
    public function key()
    {
        return $this->position;
    }

    /**
     * Move forward to next element
     * 
     * @return void
     */
    public function next()
    {
        ++$this->position;
    }

    /**
     * Whether or not an offset exists.
     * 
     * @param mixed $offset
     * 
     * @return boolean
     */
    public function offsetExists($offset)
    {
        return isset($this->messages[$offset]);
    }

    /**
     * Offset to retrieve.
     * 
     * @param mixed $offset
     * 
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return isset($this->messages[$offset]) ? $this->messages[$offset] : null;
    }

    /**
     * Offset to set.
     * 
     * @param mixed              $offset
     * @param \FurryBear\Message $value
     * 
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->messages[] = $value;
        } else {
            $this->messages[$offset] = $value;
        }
    }

    /**
     * Offset to unset.
     * 
     * @param mixed $offset
     * 
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->messages[$offset]);
    }

    /**
     * Rewind the Iterator to the first element.
     * 
     * @return void
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * Checks if current position is valid.
     * 
     * @return boolean
     */
    public function valid()
    {
        return isset($this->messages[$this->position]);
    }
    
    /**
     * String presentation of the object.
     * 
     * @return string
     */
    public function __toString()
    {
        $all = '';
        foreach ($this->messages as $message) {
            $all .= (string)$message;
        }
        
        return $all;
    }
}