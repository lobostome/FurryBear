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

namespace FurryBear\Resource\SunlightCapitolWords\Method;

use FurryBear\Resource\SunlightCapitolWords\BaseResource;

/**
 * This class gives access to Sunlight Capitol Words phrases resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class Phrases extends BaseResource
{
    /**
     * The endpoint name
     * 
     * @var string 
     */
    protected $baseMethod = 'phrases';
    
    /**
     * The entity name
     * 
     * @var type 
     */
    protected $entity = '';
    
    /**
     * The response format
     * 
     * @var type 
     */
    protected $format = '.json';
    
    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL.
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod($this->baseMethod . $this->format);
    }
    
    /**
     * Set the entity.
     * 
     * @param string $name The entity name
     * 
     * @return \FurryBear\Resource\SunlightCapitolWords\Method\Phrases
     */
    public function entity($name = '')
    {
        $entity = ($name) ? '/' . $name : '';
        $this->setResourceMethod($this->baseMethod . $entity . $this->format);
        
        return $this;
    }
}