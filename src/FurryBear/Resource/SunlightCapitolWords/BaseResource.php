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

namespace FurryBear\Resource\SunlightCapitolWords;

use FurryBear\Resource\AbstractResource,
    FurryBear\Exception\NotImplementedException,
    FurryBear\Exception\InvalidArgumentException;;

/**
 * A base presentation of SunlightCapitolWords resource.
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
    protected function buildQuery(array $params)
    {        
        if (count($this->getRequired()) != 0 && 
            (count(array_intersect_key($params, array_flip($this->getRequired()))) != count($this->getRequired()))) {
            throw new InvalidArgumentException("Invalid number of required parameters. Required parameters are: " . implode(", ", $this->getRequired()));
        }
        
        $apiKey = array();
        if (method_exists($this->furryBear->getProvider(), 'getApiKey')) {
            $apiKey['apikey'] = $this->furryBear->getProvider()->getApiKey();
        }
        
        // convert booleans to string representation
        array_walk ($params, function(&$item, $key) {
                if (is_bool($item)) {
                    $item = ($item) ? 'true' : 'false';
                }
            }
        );
        
        return $this->furryBear->getProvider()->getServiceUrl() 
               . '/' .
               $this->getResourceMethod() 
               . '?' .
               http_build_query(array_merge($apiKey, $params));
    }

    /**
     * Gets an iterator that can iterate over multiple result pages.
     * 
     * @throws \FurryBear\Exception\NotImplementedException
     */
    public function getIterator()
    {
        throw new NotImplementedException("This resource does not support iteration");
    }
}