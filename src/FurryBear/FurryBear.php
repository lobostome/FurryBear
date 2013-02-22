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

namespace FurryBear;

use FurryBear\Provider\AbstractProvider,
    FurryBear\Output\OutputStrategy;

/**
 * The main class that glues it all together.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class FurryBear
{
    /**
     * The library version.
     */
    const VERSION = '0.1.4';
    
    /**
     * The concrete API provider.
     * 
     * @var \FurryBear\Provider\AbstractProvider
     */
    protected $provider = null;
    
    /**
     * Defines the format of the output.
     * 
     * @var \FurryBear\Output\OutputStrategy
     */
    protected $output = null;

    /**
     * Register a concrete API provider.
     * 
     * @param \FurryBear\Provider\AbstractProvider $provider An API provider.
     * 
     * @return \FurryBear\FurryBear
     */
    public function registerProvider(AbstractProvider $provider)
    {
        $this->provider = $provider;
        return $this;
    }
    
    /**
     * Get the concrete API provider.
     * 
     * @return \FurryBear\Provider\AbstractProvider
     */
    public function getProvider()
    {
        return $this->provider;
    }
    
    /**
     * Register an output format.
     * 
     * @param \FurryBear\Output\OutputStrategy $output The desired output conversion.
     * 
     * @return \FurryBear\FurryBear
     */
    public function registerOutput(OutputStrategy $output)
    {
        $this->output = $output;
        return $this;
    }
    
    /**
     * Get the output format.
     * 
     * @return \FurryBear\Output\OutputStrategy
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Get library version.
     * 
     * @return string
     */
    public static function getVersion()
    {
        return self::VERSION;
    }
}