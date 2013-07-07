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
    FurryBear\Common\Exception\NoResultException;

/**
 * OpenStreetMap geocode provider
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://wiki.openstreetmap.org/wiki/Nominatim
 */

class OpenStreetMap extends AbstractProvider
{
    /**
     * The Geocoding API request URL
     */
    const ENDPOINT_URL = 'http://nominatim.openstreetmap.org/search?q=%s&format=xml&addressdetails=1&limit=1';
    
    /**
     * Construct the geocoder and set a custom user agent based on Nominatim 
     * usage policy at http://wiki.openstreetmap.org/wiki/Nominatim_usage_policy
     */
    public function __construct()
    {
        $this->setOutput(new \FurryBear\Output\Strategy\XmlToObject());
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
        $url = sprintf(self::ENDPOINT_URL, urlencode($address));
        $obj = $this->get($url);
        
        if (!$obj->place[0]) {
            throw new NoResultException('Could not geocode the address: ' . $address);
        }
        
        $result = $obj->place[0];
        
        return array('latitude'     => (string) $result->attributes()->lat, 
                     'longitude'    => (string) $result->attributes()->lon);
    }
}