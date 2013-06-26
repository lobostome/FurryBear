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

namespace FurryBear\Resource;

use FurryBear\Exception\InvalidArgumentException;

/**
 * A factory that aids creating resource objects.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class ResourceFactory
{
    /**
     * Create a resource based on a provider and resource name.
     * 
     * The rules to create a resource class name are:
     * 1. Explode by underscore.
     * 2. Capitalize each resulting array element.
     * 3. Join back together the array elements into a string.
     * 
     * @param \FurryBear\FurryBear $furryBear A FurryBear reference.
     * @param string               $name      Resource property name.
     * 
     * @return \FurryBear\Resource\AbstractResource
     * 
     * @throws FurryBear\Exception\InvalidArgumentException
     */
    public static function create($furryBear, $name)
    {
        $policyFqn = '\FurryBear\Resource\\' . $furryBear->getProvider()->getDirectory() . '\FqnPolicy';
        $policy = new $policyFqn();
        
        $fqn = $policy->map($furryBear->getProvider()->getDirectory(), $name);
        
        if (!class_exists($fqn)) {
            throw new InvalidArgumentException($fqn . " resource does not exist");
        }

        return new $fqn($furryBear);
    }
}