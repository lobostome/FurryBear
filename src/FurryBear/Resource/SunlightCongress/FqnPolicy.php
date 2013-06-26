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

namespace FurryBear\Resource\SunlightCongress;

use FurryBear\Resource\PolicyInterface;

/**
 * A specific policy for mapping Sunlight Congress resource names to fully 
 * qualified class names.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class FqnPolicy implements PolicyInterface
{
    /**
     * {@inheritdoc}
     * 
     * @param string $providerDirectory The provider resource directory
     * @param string $resourceProperty  The resource property
     * 
     * @return string The fully qualified name
     */
    public function map($providerDirectory, $resourceProperty)
    {
        $classParts = explode("_", $resourceProperty);
        array_walk($classParts, function(&$item, $key) { $item = ucfirst($item); });
        $className = join("", $classParts);
        
        return '\\FurryBear\\Resource\\' . $providerDirectory . '\Method\\' . $className;
    }
}