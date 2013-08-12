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
 * A special provider that iterates over a list of providers until a valid 
 * result is returned.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     http://wiki.openstreetmap.org/wiki/Nominatim
 */

class Chain extends AbstractProvider
{
    /**
     * An array of providers to iterate over.
     * 
     * @var array 
     */
    protected $providers = array();
    
    /**
     * Sets the providers.
     * 
     * @param array $providers An array of providers.
     */
    public function __construct(array $providers = array())
    {
        $this->providers = $providers;
    }
    
    /**
     * {@inheritdoc}
     * 
     * @param string $address The target address

     * @return array
     * 
     * @throws NoResultException
     */
    public function geocode($address)
    {
        foreach ($this->providers as $provider) {
            try {
                $provider->setAdapter($this->getAdapter());
                return $provider->geocode($address);
            } catch (\Exception $e) {
                // Ignore the exception and proceed with the next provider
            }
        }
        
        throw new NoResultException(sprintf('Could not geocode the address: %s', $address));
    }
}