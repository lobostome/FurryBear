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

namespace FurryBear\Geocode;

/**
 * An abstract presentation of a geocode provider.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
abstract class AbstractProvider
{
    /**
     * The HTTP client
     * 
     * @var \FurryBear\Http\HttpAdapterInterface 
     */
    protected $adapter;
    
    /**
     * The output strategy
     * 
     * @var \FurryBear\Output\Strategy 
     */
    protected $output;
        
    /**
     * Converts an address into geographic coordinates
     * 
     * @param string $address The target address
     * 
     * @return array
     */
    abstract public function geocode($address);
    
    /**
     * Set the HTTP adapter
     * 
     * @param \FurryBear\Http\HttpAdapterInterface $adapter The HTTP adapter
     * 
     * @return void
     */
    public function setAdapter(\FurryBear\Http\HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    
    /**
     * Get an instance of the HTTP adapter
     * 
     * @return \FurryBear\Http\HttpAdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
    
    /**
     * Set the output strategy
     * 
     * @param \FurryBear\Output\Strategy $output The output strategy
     * 
     * @return void
     */
    public function setOutput(\FurryBear\Output\Strategy $output)
    {
        $this->output = $output;
    }
    
    /**
     * Get an instance of the output strategy
     * 
     * @return \FurryBear\Output\Strategy
     */
    public function getOutput()
    {
        return $this->output;
    }
    
    /**
     * Make a connection with the service and retrieve the information
     * 
     * @param string $url The service endpoint url
     * 
     * @return mixed
     */
    public function get($url)
    {
        return $this->getOutput()
                    ->convert($this->getAdapter()
                                   ->getContent($url));
    }
}