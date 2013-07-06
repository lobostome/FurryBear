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
    FurryBear\Common\Validation\Validator\RequireAtLeast as RequireAtLeastValidator;

/**
 * This class gives access to Sunlight Capitol Words text resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class Text extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'text.json';
    
    /**
     * The required query parameters for this resource.
     * 
     * @var array
     */
    protected $requiredQueryParams = array('phrase', 'title');

    /**
     * Constructs the resource, sets a reference to the FurryBear object, and 
     * sets the resource method URL.
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
        $this->setResourceMethod(self::ENDPOINT_METHOD);
        $this->setRequired($this->requiredQueryParams);
        $this->addValidators();
    }
    
    /**
     * Adds validators to the engine.
     * 
     * @return void
     */
    protected function addValidators()
    {
        $this->getValidation()->add('required', new RequireAtLeastValidator(array(
            'message' => "Invalid number of required parameters. At least one of these is required: " . implode(", ", $this->getRequired()),
            'domain' => $this->getRequired(),
            'number' => 1
        )));
    }
}