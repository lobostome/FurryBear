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

namespace FurryBear\Tests\Resource\SunlightCongress;

/**
 * A test for SunlightCongress\LegislatorsLocate.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class LegislatorsLocateTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    
    /**
     * @var \FurryBear\Resource\SunlightCongress\LegislatorsLocate
     */
    protected $legislatorsLocate;
    
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
        
        $provider = new \FurryBear\Provider\Source\SunlightCongress($adapter, $this->apiKey);
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        
        $this->furryBear = new \FurryBear\FurryBear();
        $this->furryBear->registerProvider($provider)
                        ->registerOutput($output);
        
        $this->legislatorsLocate = new \FurryBear\Resource\SunlightCongress\LegislatorsLocate($this->furryBear);
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
        unset($this->legislatorsLocate);
        unset($this->apiKey);
    }
    
    /**
     * Test setting the resource method.
     */
    public function testConstruct()
    {
        $this->assertAttributeNotEmpty('resourceMethod', $this->legislatorsLocate);
        $this->assertAttributeInternalType('string', 'resourceMethod', $this->legislatorsLocate);
        $this->assertAttributeEquals(\FurryBear\Resource\SunlightCongress\LegislatorsLocate::LEGISLATORS_LOCATE_METHOD, 'resourceMethod', $this->legislatorsLocate);
    }
    
    public function testGetByZip()
    {
        $this->assertNull($this->legislatorsLocate->getByZip('12345'));
    }
}