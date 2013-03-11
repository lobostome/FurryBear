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

/**
 * This class gives access to Sunlight Congress legislators/locate resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class LegislatorsLocate extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const LEGISLATORS_LOCATE_METHOD = 'legislators/locate';
    
    /**
     * The geocoding service provider
     * 
     * @var \FurryBear\Geocode\AbstractProvider 
     */
    protected $geocodeProvider;

    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL.
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod(self::LEGISLATORS_LOCATE_METHOD);
    }
    
    /**
     * Retrieves legislators based on a zip
     * 
     * @param string $zip
     * 
     * @return mixed
     */
    public function getByZip($zip)
    {
        $params = array('zip' => (string)$zip);
        return $this->get($params);
    }
    
    /**
     * Retrieves legislators based on an address
     * 
     * @param string $address The target address
     * 
     * @return mixed
     */
    public function getByAddress($address)
    {
        $params = $this->geocodeProvider->geocode($address);
        return $this->get($params);
    }
    
    /**
     * Set the geocode provider and its adapter and output strategy.
     * 
     * @param \FurryBear\Geocode\AbstractProvider $provider The geocode provider
     * 
     * @return \FurryBear\Resource\SunlightFoundation\LegislatorsLocate
     */
    public function via(\FurryBear\Geocode\AbstractProvider $provider)
    {
        $this->geocodeProvider = $provider;
        $this->geocodeProvider->setAdapter($this->furryBear->getProvider()->getAdapter());
        
        return $this;
    }
}