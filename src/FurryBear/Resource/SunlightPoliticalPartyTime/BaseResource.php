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
    FurryBear\Iterator\SunlightPoliticalPartyTime\PageIterator;

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
                                   http_build_query(array_merge($apiKey, $this->buildFormat(), $params)));
    }
    
    /**
     * Creates parameter for format type.
     * 
     * @return array
     */
    protected function buildFormat()
    {
        return array('format' => $this->extractFormat());
    }
    
    /**
     * Extracts the format type from the output.
     * 
     * @return string
     */
    public function extractFormat()
    {
        $format = 'json';
        $class = strtolower(get_class($this->furryBear->getOutput()));
        if (strpos($class, 'json') === FALSE) {
            $format = 'xml';
        }
        
        return $format;
    }

    /**
     * Gets an iterator that can iterate over multiple result pages
     * 
     * @return \FurryBear\Iterator\SunlightPoliticalPartyTime\PageIterator
     */
    public function getIterator()
    {
        return new PageIterator($this);
    }
}