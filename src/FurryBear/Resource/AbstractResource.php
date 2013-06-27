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
abstract class AbstractResource implements \IteratorAggregate
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
     * The parameters sent with the request.
     * 
     * @var array
     */
    protected $params = array();
    
    /**
     * Required parameters.
     * 
     * @var array
     */
    protected $required = array();

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
    abstract protected function buildQuery(array $params);
    
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
    
    /**
     * Set the request parameters.
     * 
     * @param array $params The request parameters
     * 
     * @return \FurryBear\Resource\AbstractResource
     */
    public function setParams(array $params)
    {
        $this->params = array_merge($this->params, $params);
        return $this;
    }
    
    /**
     * Gets the request parameters.
     * 
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }
    
    /**
     * Clear previously set parameters
     * 
     * @return \FurryBear\Resource\AbstractResource
     */
    public function clearParams()
    {
        $this->params = array();
        return $this;
    }
    
    /**
     * Set required parameters.
     * 
     * @param array $params
     * 
     * @return void
     */
    protected function setRequired(array $params)
    {
        $this->required = $params;
    }
    
    /**
     * Get required parameters.
     * 
     * @return array
     */
    protected function getRequired()
    {
        return $this->required;
    }
    
    /**
     * Retrieves a result based on some criteria.
     * 
     * @param array $params Search criteria.
     * 
     * @return mixed
     */
    public function get(array $params = array())
    {
        if (!empty($params)) {
            $this->setParams($params);
        }
        
        $result = $this->furryBear
                       ->getOutput()
                       ->convert($this->furryBear
                                      ->getProvider()
                                      ->getAdapter()
                                      ->getContent($this->buildQuery($this->params)));
        
        $this->clearParams();
        
        return $result;
    }
}