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

use FurryBear\Common\DI\DI,
    FurryBear\Http\Adapter\Curl,
    FurryBear\Provider\Source\SunlightCongress,
    FurryBear\Output\Strategy\JsonToArray,
    FurryBear\FurryBear;

/**
 * A container with pre-registered services.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class FurryBearContainer extends DI
{
    /**
     * Registers services to quickly start with Sunlight Congress API.
     */
    public function __construct()
    {
        $this['apikey'] = 'Change Me';
        
        $this['adapter'] = function() {
            return new Curl();
        };
        
        $this['provider'] = function($this) {
            return new SunlightCongress($this['adapter'], $this['apikey']);
        };
        
        $this['output'] = function($this) {
            return new JsonToArray();
        };
        
        $this['furrybear'] = function($this) {
            $fb = new FurryBear();
            $fb->registerProvider($this['provider'])
               ->registerOutput($this['output']);
            
            return $fb;
        };
    }
}