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

namespace FurryBear\Iterator\SunlightFoundation;

use FurryBear\Resource\AbstractResource;

/**
 * An iterator that iterates over the pages of the result.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class PageIterator implements \Iterator
{
    /**
     * A reference to the resource.
     * 
     * @var \FurryBear\Resource\AbstractResource
     */
    protected $resource;
    
    /**
     * Construct an iterator and set the resource.
     * 
     * @param \FurryBear\Resource\AbstractResource $resource A reference to a resource.
     */
    public function __construct(AbstractResource $resource)
    {
        $this->resource = $resource;
    }
    
    public function current()
    {
        
    }

    public function key()
    {
        
    }

    public function next()
    {
        
    }

    public function rewind()
    {
        
    }

    public function valid() {
        
    }
}