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

namespace FurryBear\Tests\Resource;

/**
 * A test for ResourceFactory.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class ResourceFactoryTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    
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
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
    }
    
    /**
     * Test creating a resource object.
     */
    public function testCreate()
    {
        $expectedClass = '\\FurryBear\\Resource\\SunlightCongress\\Method\\Bills';
        $actualObj = \FurryBear\Resource\ResourceFactory::create($this->furryBear, 'bills');
        
        $this->assertNotNull($actualObj);
        $this->assertInstanceOf($expectedClass, $actualObj);
    }
}