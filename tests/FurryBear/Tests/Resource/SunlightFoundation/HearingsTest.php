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

namespace FurryBear\Tests\Resource\SunlightFoundation;

/**
 * A test for SunlightFoundation\Hearings.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class HearingsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    
    /**
     * @var \FurryBear\Resource\SunlightFoundation\Hearings
     */
    protected $hearings;
    
    /**
     * @var string
     */
    protected $apiKey = 'some-api-key';

    /**
     * Set up fixtures.
     */
    protected function setUp()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $provider = new \FurryBear\Provider\Source\SunlightFoundation($adapter, $this->apiKey);
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        
        $this->furryBear = new \FurryBear\FurryBear();
        $this->furryBear->registerProvider($provider)
                        ->registerOutput($output);
        
        $this->hearings = new \FurryBear\Resource\SunlightFoundation\Hearings($this->furryBear);
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
        unset($this->hearings);
        unset($this->apiKey);
    }
    
    /**
     * Test setting the resource method.
     */
    public function testConstruct()
    {
        $this->assertAttributeNotEmpty('resourceMethod', $this->hearings);
        $this->assertAttributeInternalType('string', 'resourceMethod', $this->hearings);
        $this->assertAttributeEquals(\FurryBear\Resource\SunlightFoundation\Hearings::HEARINGS_METHOD, 'resourceMethod', $this->hearings);
    }
}