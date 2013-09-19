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

namespace FurryBear\Iterator\SunlightPoliticalPartyTime;

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
        
        if (!isset($this->params['limit'])) {
            $this->params['limit'] = 50;
        }
        
        if (!isset($this->params['offset'])) {
            $this->params['offset'] = 0;
        }
    }
    
    /**
     * Return the current element. Determine if end of iteration.
     * 
     * @return object|array
     */
    public function current()
    {
        $result = $this->resource->get($this->params);
        
        switch ($this->resource->extractFormat()) {
            case 'json':
                if (is_array($result)) {
                    if (!is_string($result['meta']['next'])) {
                        $this->isEnd = TRUE;
                    }
                } else if (is_object($result)) {
                    if (!is_string($result->meta->next)) {
                        $this->isEnd = TRUE;
                    }
                }
                break;
            case 'xml':
                if (strlen((string)$result->meta->next) == 0) {
                    $this->isEnd = TRUE;
                }
                break;
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
        $this->params['offset'] += $this->params['limit'];
    }

    /**
     * Rewind the Iterator to the first element
     * 
     * @return void
     */
    public function rewind()
    {
        $this->params['offset'] = 0;
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