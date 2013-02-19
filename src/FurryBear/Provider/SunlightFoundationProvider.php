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

use FurryBear\HttpAdapter\HttpAdapterInterface;

/**
 * A concrete provider based on Sunlight Foundation Congress API v3.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://sunlightlabs.github.com/congress/
 */
class SunlightFoundationProvider extends AbstractProvider
{
    /**
     * The domain of the API.
     */
    const SERVICE_URL = 'http://congress.api.sunlightfoundation.com';
    
    /**
     * The Sunlight API key.
     * 
     * @var string
     */
    protected $apiKey;
    
    /**
     * Construct the provider and bind to a HTTP adapter.
     * 
     * @param \FurryBear\HttpAdapter\HttpAdapterInterface $adapter The HTTP adapter
     * @param string $apiKey  The service API key.
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
}