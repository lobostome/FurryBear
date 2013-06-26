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
 * A contract for class-to-endpoint mapping.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

interface PolicyInterface
{
    /**
     * Maps a resource name to a fully qualified name
     * 
     * @param string $providerDirectory The provider resource directory
     * @param string $resourceProperty  The resource property
     * 
     * @return string A fully qualified name
     * 
     * @see http://php.net/manual/en/language.namespaces.rules.php
     */
    public function map($providerDirectory, $resourceProperty);
}