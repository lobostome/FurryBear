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
namespace FurryBear\Resource;
/**
 * An abstract presentation of a resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
abstract class AbstractResource
{
    /**
     * A reference to the FurryBear object.
     * 
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    
    /**
     * The resource method URL.
     * 
     * @var string
     */
    protected $resourceMethod;
    
    /**
     * Construct a resource with a FurryBear instance.
     * 
     * @param \FurryBear\FurryBear $furryBear A FurryBear instance.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        $this->furryBear = $furryBear;
    }
    
    /**
     * Builds the entire query URL, including the request criteria.
     * 
     * @param array $params The search criteria.
     * 
     * @return string
     */
    abstract protected function buildQuery($params);
    
    /**
     * Retrieves a result based on some criteria.
     * 
     * @param array $params Search criteria.
     * 
     * @return mixed
     */
    public function get($params)
    {
        return $this->furryBear
                    ->getOutput()
                    ->convert($this->furryBear
                                   ->getProvider()
                                   ->getAdapter()
                                   ->getContent($this->buildQuery($params)));
    }
    
    /**
     * Gets the resource method URL.
     * 
     * @return string
     */
    protected function getResourceMethod()
    {
        return $this->resourceMethod;
    }
    
    /**
     * Sets the resource method URL.
     * 
     * @param string $resourceMethod The resource method URL.
     * 
     * @return void
     */
    protected function setResourceMethod($resourceMethod)
    {
        $this->resourceMethod = $resourceMethod;
    }
}