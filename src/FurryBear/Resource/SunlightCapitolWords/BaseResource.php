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
    FurryBear\Common\Exception\NotImplementedException,
    FurryBear\Common\Exception\InvalidArgumentException,
    FurryBear\Common\Validation\Engine as ValidationEngine;

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
     * A reference to the validation engine.
     * 
     * @var \FurryBear\Common\Validation\Engine
     */
    protected $validation;
    
    /**
     * Required query parameters.
     * 
     * @var array
     */
    protected $required;

    /**
     * Construct a resource with a FurryBear instance.
     * 
     * @param \FurryBear\FurryBear $furryBear A FurryBear instance.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->validation = new ValidationEngine();
    }

    /**
     * {@inheritdoc}
     * 
     * @param array $params The search criteria.
     * 
     * @return string
     * @throws InvalidArgumentException
     */
    protected function buildQuery(array $params)
    {
        // Run the validation
        $this->validation->populate(array("required" => $params));
        
        if (!$this->validation->isValid()) {
            $messageGroup = $this->validation->getMessages();
            throw new InvalidArgumentException($messageGroup->__toString());
        }
        
        // Get the API key
        $apiKey = array();
        if (method_exists($this->furryBear->getProvider(), 'getApiKey')) {
            $apiKey['apikey'] = $this->furryBear->getProvider()->getApiKey();
        }
        
        // Convert booleans to string representation
        array_walk ($params, function(&$item, $key) {
                if (is_bool($item)) {
                    $item = ($item) ? 'true' : 'false';
                }
            }
        );
        
        // Construct the request URI
        return $this->furryBear->getProvider()->getServiceUrl() 
               . '/' .
               $this->getResourceMethod() 
               . '?' .
               http_build_query(array_merge($apiKey, $params));
    }
    
    /**
     * Sets the validation service.
     * 
     * @param FurryBear\Common\Validation\Engine $validation
     * 
     * @return void
     */
    protected function setValidation($validation)
    {
        $this->validation = $validation;
    }
    
    /**
     * Get the validation service.
     * 
     * @return FurryBear\Common\Validation\Engine
     */
    protected function getValidation()
    {
        return $this->validation;
    }
    
    /**
     * Sets required query parameters.
     * 
     * @param array $params
     * 
     * @return void
     */
    protected function setRequired($params)
    {
        $this->required = $params;
    }
    
    /**
     * Gets required query parameters.
     * 
     * @return array
     */
    protected function getRequired()
    {
        return $this->required;
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