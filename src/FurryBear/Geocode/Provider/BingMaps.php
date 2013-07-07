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

namespace FurryBear\Geocode\Provider;

use FurryBear\Geocode\AbstractProvider,
    FurryBear\Common\Exception\InvalidCredentialsException,
    FurryBear\Common\Exception\NoResultException;

/**
 * Bing Maps geocode provider
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://msdn.microsoft.com/en-us/library/ff701714.aspx
 */

class BingMaps extends AbstractProvider
{
    /**
     * The Geocoding API request URL
     */
    const ENDPOINT_URL = 'http://dev.virtualearth.net/REST/v1/Locations?q=%s&key=%s';
    
    /**
     * The Geocoding API request URL over HTTPS
     */
    const ENDPOINT_URL_SSL = 'https://dev.virtualearth.net/REST/v1/Locations?q=%s&key=%s';

    /**
     * Enable use of HTTPS request
     * 
     * @var boolean
     */
    protected $useSsl;
    
    /**
     * The service API key
     * 
     * @var string
     */
    protected $apiKey;
    
    /**
     * Construct the geocoder with a API key and instruct whether the request is
     * made over HTTPS
     * 
     * @param string  $apiKey The service API key
     * @param boolean $useSsl Use HTTPS or not
     */
    public function __construct($apiKey, $useSsl = false)
    {
        if (empty($apiKey)) {
            throw new InvalidCredentialsException('Bing Maps requires an API key');
        }
        
        $this->apiKey = $apiKey;
        $this->useSsl = $useSsl;
        
        $this->setOutput(new \FurryBear\Output\Strategy\JsonToObject());
    }
    
    /**
     * {@inheritdoc}
     * 
     * @param string $address The target address
     * 
     * @return array
     */
    public function geocode($address)
    {
        $url = sprintf($this->useSsl ? self::ENDPOINT_URL_SSL : self::ENDPOINT_URL, urlencode($address), $this->apiKey);
        $jsonObj = $this->get($url);
        
        if (isset($jsonObj->resourceSets[0]) && isset($jsonObj->resourceSets[0]->resources[0])) {
            $result = $jsonObj->resourceSets[0]->resources[0];
        } else {
            throw new NoResultException('Could not geocode the address: ' . $address);
        }
                
        return array('latitude'  => $result->geocodePoints[0]->coordinates[0], 
                     'longitude' => $result->geocodePoints[0]->coordinates[1]);
    }
}