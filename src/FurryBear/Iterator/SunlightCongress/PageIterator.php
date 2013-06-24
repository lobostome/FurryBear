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

namespace FurryBear\Iterator\SunlightCongress;

use FurryBear\Resource\AbstractResource;

/**
 * An iterator over the pages of the result.
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
     * A cache of the resource parameters.
     * 
     * @var array
     */
    protected $params;
    
    /**
     * Total number of available pages.
     * 
     * @var integer
     */
    protected $totalPages = 1;

    /**
     * Construct an iterator and set the resource.
     * 
     * @param \FurryBear\Resource\AbstractResource $resource A reference to a resource.
     */
    public function __construct(AbstractResource $resource)
    {
        $this->resource = $resource;
        $this->params = $this->resource->getParams();
        
        if (!isset($this->params['page'])) {
            $this->params['page'] = 1;
        }
        
        if (!isset($this->params['per_page'])) {
            $this->params['per_page'] = 20;
        }
    }
    
    /**
     * Return the current element. On first request, also set the number of pages.
     * 
     * @return object|array
     */
    public function current()
    {
        $result = $this->resource->get($this->params);
        if ($this->params['page'] == 1) {
            if (is_object($result)) {
                $this->totalPages = ceil($result->count / $result->page->per_page);
            } else if (is_array($result)) {
                $this->totalPages = ceil($result['count'] / $result['page']['per_page']);
            }
        }
        
        return $result;
    }

    /**
     * Returns the key of the current element.
     * 
     * @return scalar
     * @throws \FurryBear\Exception\NotImplementedException This method does not exist.
     */
    public function key()
    {
        throw new \FurryBear\Exception\NotImplementedException('Method ' . __METHOD__ . ' is not implemented');
    }

    /**
     * Move forward to next element
     * 
     * @return void
     */
    public function next()
    {
        $this->params['page'] += 1;
    }

    /**
     * Rewind the Iterator to the first element
     * 
     * @return void
     */
    public function rewind()
    {
        $this->params['page'] = 1;
    }

    /**
     * Checks if current position is valid
     * 
     * @return boolean
     */
    public function valid()
    {   
        return ($this->params['page'] <= $this->totalPages);
    }
}