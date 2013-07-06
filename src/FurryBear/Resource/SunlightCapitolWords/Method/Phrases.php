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

namespace FurryBear\Resource\SunlightCapitolWords\Method;

use FurryBear\Resource\SunlightCapitolWords\BaseResource,
    FurryBear\Common\Validation\Validator\RequireAll as RequireAllValidator;

/**
 * This class gives access to Sunlight Capitol Words phrases resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class Phrases extends BaseResource
{
    /**
     * The endpoint name
     * 
     * @var string 
     */
    protected $baseMethod = 'phrases';
    
    /**
     * The entity name
     * 
     * @var type 
     */
    protected $entity = '';
    
    /**
     * The response format
     * 
     * @var type 
     */
    protected $format = '.json';
    
    /**
     * The required parameters for this resource.
     * 
     * @var array
     */
    protected $requiredQueryParams = array('entity_type', 'entity_value');
    
    /**
     * The required parameters for entities.
     * 
     * @var array
     */
    protected $requiredEntityQueryParams = array('phrase');
    
    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL.
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod($this->baseMethod . $this->format);
        $this->setRequired($this->requiredQueryParams);
        $this->addValidators();
    }
    
    /**
     * Set the entity.
     * 
     * @param string $name The entity name
     * 
     * @return \FurryBear\Resource\SunlightCapitolWords\Method\Phrases
     */
    public function entity($name = '')
    {
        $entity = ($name) ? '/' . $name : '';
        $this->setResourceMethod($this->baseMethod . $entity . $this->format);
        
        // remove existing validators
        $this->getValidation()->remove('required');
        
        // set the new required query parameters
        if (!empty($entity)) {
            $this->setRequired($this->requiredEntityQueryParams);
        } else {
            $this->setRequired($this->requiredQueryParams);
        }
        
        // add new validators
        $this->addValidators();
        
        return $this;
    }
    
    /**
     * Adds validators to the engine.
     * 
     * @return void
     */
    protected function addValidators()
    {
        $this->getValidation()->add('required', new RequireAllValidator(array(
            'message' => "Invalid number of required parameters. Required parameters are: " . implode(", ", $this->getRequired()),
            'domain' => $this->getRequired()
        )));
    }
}