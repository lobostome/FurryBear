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

namespace FurryBear\Resource\SunlightFoundation;

use FurryBear\Resource\AbstractResource;

/**
 * A base presentation of SunlightFoundation resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class BaseResource extends AbstractResource
{
    /**
     * Construct a resource with a FurryBear instance.
     * 
     * @param \FurryBear\FurryBear $furryBear A FurryBear instance.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
    }

    /**
     * {@inheritdoc}
     * 
     * @param array $params The search criteria.
     * 
     * @return string
     */
    protected function buildQuery($params)
    {
        $apiKey = array();
        if (method_exists($this->furryBear->getProvider(), 'getApiKey')) {
            $apiKey['apikey'] = $this->furryBear->getProvider()->getApiKey();
        }
        
        return $this->furryBear->getProvider()->getServiceUrl() 
               . '/' .
               $this->getResourceMethod() 
               . '?' .
               http_build_query(array_merge($apiKey, $params));
    }
    
    /**
     * {@inheritdoc}
     * 
     * @param array $params Search criteria.
     * 
     * @return mixed
     */
    public function get($params)
    {
        return $this->furryBear->getProvider()->getAdapter()->getContent($this->buildQuery($params));
    }
}