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

use FurryBear\Geocode\AbstractProvider;

/**
 * Google Maps geocode provider
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://developers.google.com/maps/documentation/geocoding/
 */

class GoogleMaps extends AbstractProvider
{
    /**
     * The Geocoding API request URL
     */
    const ENDPOINT_URL = 'http://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';
    
    /**
     * The Geocoding API request URL over HTTPS
     */
    const ENDPOINT_URL_SSL = 'https://maps.googleapis.com/maps/api/geocode/json?address=%s&sensor=false';

    /**
     * Enable use of HTTPS request
     * 
     * @var boolean
     */
    protected $useSsl;
    
    /**
     * Construct the geocoder and instruct whether the request is made over HTTPS
     * 
     * @param boolean $useSsl Use HTTPS or not
     */
    public function __construct($useSsl = false)
    {
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
        $url = sprintf($this->useSsl ? self::ENDPOINT_URL_SSL : self::ENDPOINT_URL, urlencode($address));
        $jsonObj = $this->get($url);
        
        $result = $jsonObj->results[0];
        
        return array('latitude'     => $result->geometry->location->lat, 
                     'longitude'    => $result->geometry->location->lng);
    }
}