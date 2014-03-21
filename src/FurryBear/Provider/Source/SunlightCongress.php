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

namespace FurryBear\Provider\Source;

use FurryBear\Http\HttpAdapterInterface,
    FurryBear\Provider\AbstractProvider;

/**
 * A concrete provider based on Sunlight Foundation Congress API v3.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class SunlightCongress extends AbstractProvider
{
    /**
     * The domain of the API.
     */
    const SERVICE_URL = 'https://congress.api.sunlightfoundation.com';
    
    /**
     * The resource directory.
     */
    const RESOURCE_DIR = 'SunlightCongress';
    
    /**
     * The Sunlight API key.
     * 
     * @var string
     */
    protected $apiKey = '';
    
    /**
     * Construct the provider and bind to a HTTP adapter.
     * 
     * @param \FurryBear\Http\HttpAdapterInterface $adapter The HTTP adapter
     * @param string                               $apiKey  The service API key.
     */
    public function __construct(HttpAdapterInterface $adapter, $apiKey)
    {
        parent::__construct($adapter);
        $this->apiKey = $apiKey;
    }
    
    /**
     * Get the domain of the API.
     * 
     * @return string
     */
    public function getServiceUrl()
    {
        return self::SERVICE_URL;
    }
    
    /**
     * Set the API key.
     * 
     * @param string $apiKey The service API key.
     * 
     * @return void
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }
    
    /**
     * Get the API key.
     * 
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * {@inheritdoc}
     * 
     * @return string
     */
    public function getDirectory()
    {
        return self::RESOURCE_DIR;
    }
}