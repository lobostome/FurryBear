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

namespace FurryBear\Resource\SunlightPoliticalPartyTime;

use FurryBear\Resource\AbstractResource,
    FurryBear\Common\Exception\NotImplementedException;

/**
 * A base presentation of Sunlight Political Party Time resource.
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
        
        return sprintf("%s/%s/?%s", $this->furryBear->getProvider()->getServiceUrl(), 
                                   $this->getResourceMethod(),
                                   http_build_query(array_merge($apiKey, $this->extractFormat(), $params)));
    }
    
    /**
     * Extracts the format from the output.
     * 
     * @return array
     */
    protected function extractFormat()
    {
        $format = array('format' => 'json');
        $class = strtolower(get_class($this->furryBear->getOutput()));
        
        if (strpos($class, 'json') === FALSE) {
            $format = array('format' => 'xml');
        }
        
        return $format;
    }

    /**
     * Gets an iterator that can iterate over multiple result pages.
     * 
     * @throws NotImplementedException
     */
    public function getIterator()
    {
        throw new NotImplementedException("This resource does not support iteration");
    }
}