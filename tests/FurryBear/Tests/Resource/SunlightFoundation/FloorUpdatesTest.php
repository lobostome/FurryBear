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
 * A test for SunlightFoundation\FloorUpdates.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class FloorUpdatesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    
    /**
     * @var \FurryBear\Resource\SunlightFoundation\FloorUpdates
     */
    protected $floorUpdates;
    
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
        
        $this->floorUpdates = new \FurryBear\Resource\SunlightFoundation\FloorUpdates($this->furryBear);
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
        unset($this->floorUpdates);
        unset($this->apiKey);
    }
    
    /**
     * Test setting the resource method.
     */
    public function testConstruct()
    {
        $this->assertAttributeNotEmpty('resourceMethod', $this->floorUpdates);
        $this->assertAttributeInternalType('string', 'resourceMethod', $this->floorUpdates);
        $this->assertAttributeEquals(\FurryBear\Resource\SunlightFoundation\FloorUpdates::FLOOR_UPDATES_METHOD, 'resourceMethod', $this->floorUpdates);
    }
}