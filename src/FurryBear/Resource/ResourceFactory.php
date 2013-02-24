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
     * @param \FurryBear\Provider\AbstractProvider $provider A provider reference.
     * @param string                               $name     Resource name.
     * 
     * @return \FurryBear\Resource\AbstractResource
     */
    public static function create($provider, $name)
    {
        $classParts = explode("_", $name);
        array_walk($classParts, function(&$item, $key) { $item = ucfirst($item); });
        $className = join("", $classParts);
        
        $fqn = '\\FurryBear\\Resource\\' . $provider->getDirectory() . '\\' . $className;
        
        return new $fqn();
    }
}