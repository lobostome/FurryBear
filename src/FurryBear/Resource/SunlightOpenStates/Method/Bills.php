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

namespace FurryBear\Resource\SunlightOpenStates\Method;

use FurryBear\Resource\SunlightOpenStates\BaseResource,
    FurryBear\Common\Exception\InvalidArgumentException,
    FurryBear\Common\Exception\NotImplementedException,
    FurryBear\Iterator\SunlightOpenStates\BillsPageIterator;

/**
 * This class gives access to Sunlight Open States bills resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class Bills extends BaseResource
{
    /**
     * The resource method URL. No slashes at the beginning and end of the 
     * string.
     */
    const ENDPOINT_METHOD = 'bills';

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
    }
    
    /**
     * Sets a sort criterion for the search.
     * 
     * @param string $by
     * @return \FurryBear\Resource\SunlightOpenStates\Method\Bills
     */
    public function sort($by = 'last')
    {
        $allowed = array('first', 'last', 'signed', 'passed_lower', 'passed_upper', 'updated_at', 'created_at');
        
        if (!in_array($by, $allowed)) {
            $message = sprintf("Sort by '%s' is not allowed.", $by);
            throw new InvalidArgumentException($message);
        }
        
        $this->setParams(array('sort' => $by));
        return $this;
    }
    
    /**
     * Controls result pagination.
     * 
     * @param int $page    Page number
     * @param int $perPage Results per page
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     */
    public function page($page = 1, $perPage = 50)
    {
        $this->setParams(array(
                'page'     => (int)$page,
                'per_page' => (int)$perPage
            )
        );
        
        return $this;
    }
    
    /**
     * {@inheritdoc}
     * 
     * @return \FurryBear\Iterator\SunlightOpenStates\BillsPageIterator
     */
    public function getIterator() 
    {   
        return new BillsPageIterator($this);
    }
    
    /**
     * Sets filters for the search.
     * 
     * @param string $name     The name of the method.
     * @param array $arguments An array of arguments.
     * 
     * @return \FurryBear\Resource\SunlightOpenStates\Method\Bills
     * 
     * @throws NotImplementedException
     */
    public function __call($name, $arguments)
    {
        if ($name !== 'filter') {
            $message = sprintf("The method '%s' is not supported", $name);
            throw new NotImplementedException($message);
        }
        
        if (count($arguments) == 2 && is_string($arguments[0]) && is_string($arguments[1])) {
            $this->setParams(array($arguments[0] => $arguments[1]));
        } else if (count($arguments) == 1 && is_array($arguments[0])) {
            $this->setParams($arguments[0]);
        } else {
            $message = sprintf("Invalid number/type of arguments for filter method");
            throw new InvalidArgumentException($message);
        }
        
        return $this;
    }
}