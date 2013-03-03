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
namespace FurryBear\Provider;

use FurryBear\Http\HttpAdapterInterface;

/**
 * An abstract provider class that sets up a basic provider.
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
     * A reference to a concrete http adapter.
     * 
     * @var \FurryBear\Http\HttpAdapterInterface
     */
    protected $adapter = null;
    
    /**
     * Set the default HTTP adapter for a provider.
     * 
     * @param \FurryBear\Http\HttpAdapterInterface $adapter An HTTP adapter.
     */
    public function __construct(HttpAdapterInterface $adapter)
    {
        $this->setAdapter($adapter);
    }
    
    /**
     * Set the default HTTP adapter for a provider.
     * 
     * @param \FurryBear\Http\HttpAdapterInterface $adapter An HTTP adapter.
     * 
     * @return void
     */
    public function setAdapter(HttpAdapterInterface $adapter)
    {
        $this->adapter = $adapter;
    }
    
    /**
     * Retrieve the HTTP adapter.
     * 
     * @return \FurryBear\Http\HttpAdapterInterface
     */
    public function getAdapter()
    {
        return $this->adapter;
    }
    
    /**
     * Get the directory that stores the resources for a provider. Usually, this 
     * is based on the name of the provider.
     * 
     * @return string
     */
    public abstract function getDirectory();
}