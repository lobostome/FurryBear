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

namespace FurryBear;

use FurryBear\Provider\AbstractProvider,
    FurryBear\Output\Strategy,
    FurryBear\Resource\ResourceFactory,
    FurryBear\Exception\NoProviderException,
    FurryBear\Exception\NoOutputException;

/**
 * The main class that glues it all together.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class FurryBear
{
    /**
     * The library version.
     */
    const VERSION = '0.1.8';
    
    /**
     * The concrete API provider.
     * 
     * @var \FurryBear\Provider\AbstractProvider
     */
    protected $provider = null;
    
    /**
     * Defines the format of the output.
     * 
     * @var \FurryBear\Output\Strategy
     */
    protected $output = null;
    
    /**
     * Overloaded resource name.
     * 
     * @var array
     */
    protected $data = array();

    /**
     * Register a concrete API provider. Clear all registered resources.
     * 
     * @param \FurryBear\Provider\AbstractProvider $provider An API provider.
     * 
     * @return \FurryBear\FurryBear
     */
    public function registerProvider(AbstractProvider $provider)
    {
        $this->provider = $provider;
        
        if (count($this->data) > 0) {
            $this->data = array();
        }
        
        return $this;
    }
    
    /**
     * Get the concrete API provider.
     * 
     * @return \FurryBear\Provider\AbstractProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    /**
     * Register an output format.
     * 
     * @param \FurryBear\Output\Strategy $output The desired output conversion.
     * 
     * @return \FurryBear\FurryBear
     */
    public function registerOutput(Strategy $output)
    {
        $this->output = $output;
        return $this;
    }
    
    /**
     * Get the output format.
     * 
     * @return \FurryBear\Output\Strategy
     */
    public function getOutput()
    {
        return $this->output;
    }
    
    /**
     * Gets a reference to a resource. If the resource is not already 
     * instantiated, then it creates it.
     * 
     * @param string $name 
     * 
     * @return \FurryBear\Resource\AbstractResource
     */
    public function __get($name) {
        if (is_null($this->provider)) {
            throw new NoProviderException('The provider is not specified.');
        }
        if (is_null($this->output)) {
            throw new NoOutputException('The output is not specified.');
        }
        if (!array_key_exists($name, $this->data)) {
            $this->data[$name] = ResourceFactory::create($this, $name);
        }
        
        return $this->data[$name];
    }
    
    /**
     * Get library version.
     * 
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }
}