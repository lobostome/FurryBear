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

namespace FurryBear\Iterator\SunlightCapitolWords;

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
class PhrasesEntityPageIterator implements \Iterator
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
     * Are there any more items?
     * 
     * @var boolean 
     */
    protected $isEnd = FALSE;

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
            $this->params['page'] = 0;
        }
        
        if (!isset($this->params['per_page'])) {
            $this->params['per_page'] = 50;
        }
    }
    
    /**
     * Return the current element. On first request, also set the number of pages.
     * 
     * @return array|null
     */
    public function current()
    {
        $result = $this->resource->get($this->params);
        
        if (count($result['results']) == 0) {
            $this->isEnd = TRUE;
            return null;
        }

        return $result;
    }

    /**
     * Returns the key of the current element.
     * 
     * @return scalar
     * @throws \FurryBear\Common\Exception\NotImplementedException This method does not exist.
     */
    public function key()
    {
        throw new \FurryBear\Common\Exception\NotImplementedException('Method ' . __METHOD__ . ' is not implemented');
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
        $this->params['page'] = 0;
    }

    /**
     * Checks if current position is valid
     * 
     * @return boolean
     */
    public function valid()
    {   
        return ($this->isEnd == FALSE);
    }
}