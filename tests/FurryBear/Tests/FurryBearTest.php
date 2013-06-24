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

namespace FurryBear\Tests;

/**
 * Test for FurryBear.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class FurryBearTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    /**
     * Set up fixtures.
     */
    protected function setUp()
    {
        $this->furryBear = new \FurryBear\FurryBear();
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
    }
    
    /**
     * Utility function that creates an abstract provider.
     */
    private function getAbstractProvider()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $provider = $this->getMockBuilder('\\FurryBear\\Provider\\AbstractProvider')
                         ->setConstructorArgs(array($adapter))
                         ->getMock();
        
        return $provider;
    }
    
    /**
     * Utility function that creates a SunlightCongress provider.
     */
    private function getSunlightCongressProvider()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $provider = new \FurryBear\Provider\Source\SunlightCongress($adapter, 'xxxxx');
        
        return $provider;
    }
    
    /**
     * Test setting a concrete provider.
     */
    public function testRegisterProvider()
    {
        // Let's register a new provider
        $provider = $this->getSunlightCongressProvider();
        $this->furryBear->registerProvider($provider);
        
        $this->assertNotNull($provider);
        $this->assertInstanceOf('\\FurryBear\\Provider\\Source\\SunlightCongress', $provider);
        $this->assertObjectHasAttribute('provider', $this->furryBear);
        $this->assertAttributeSame($provider, 'provider', $this->furryBear);
        
        // Let's call a resource and have it cached.
        $resourceName = 'bills';
        $expectedClass = '\\FurryBear\\Resource\\SunlightCongress\\Bills';
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $this->furryBear->registerOutput($output);
        $this->furryBear->{$resourceName};
        
        $this->assertAttributeNotEmpty('data', $this->furryBear);
        $this->assertArrayHasKey($resourceName, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        $this->assertAttributeContainsOnly($expectedClass, 'data', $this->furryBear);
        $this->assertCount(1, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        
        // Let's register a different provider
        // What do we have in the cached resources?
        $provider2 = $this->getAbstractProvider();
        $this->furryBear->registerProvider($provider2);
        
        $this->assertAttributeEmpty('data', $this->furryBear);
        $this->assertCount(0, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
    }
    
    /**
     * Test getting a concrete provider.
     */
    public function testGetProvider()
    {
        $provider = $this->getAbstractProvider();
        
        $this->furryBear->registerProvider($provider);
        
        $this->assertNotNull($provider);
        $this->assertInstanceOf('\\FurryBear\\Provider\\AbstractProvider', $provider);
        $this->assertObjectHasAttribute('provider', $this->furryBear);
        $this->assertAttributeSame($this->furryBear->getProvider(), 'provider', $this->furryBear);
    }
    
    /**
     * Test setting an output format.
     */
    public function testRegisterOutput()
    { 
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $this->furryBear->registerOutput($output);
        
        $this->assertNotNull($output);
        $this->assertInstanceOf('\\FurryBear\\Output\\Strategy\\JsonToObject', $output);
        $this->assertObjectHasAttribute('output', $this->furryBear);
        $this->assertAttributeSame($output, 'output', $this->furryBear);
    }
    
    /**
     * Test getting the output format.
     */
    public function testGetOutput()
    {
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $this->furryBear->registerOutput($output);
        
        $this->assertNotNull($output);
        $this->assertInstanceOf('\\FurryBear\\Output\\Strategy\\JsonToObject', $output);
        $this->assertObjectHasAttribute('output', $this->furryBear);
        $this->assertAttributeSame($this->furryBear->getOutput(), 'output', $this->furryBear);
    }
    
    /**
     * Test getting the library version.
     */
    public function testGetVersion()
    {
        $this->assertEquals(\FurryBear\FurryBear::VERSION, $this->furryBear->getVersion());
    }
    
    /**
     * Test whether a provider has been set.
     */
    public function testGetNoProviderException()
    {
        $this->setExpectedException('\\FurryBear\\Exception\\NoProviderException');
        $this->furryBear->bills;
    }
    
    /**
     * Test whether an output strategy has been set.
     */
    public function testGetNoOutputException()
    {
        $provider = $this->getAbstractProvider();
        
        $this->furryBear->registerProvider($provider);
        
        $this->setExpectedException('\\FurryBear\\Exception\\NoOutputException');
        $this->furryBear->bills;
    }
    
    /**
     * Test creating a new resource for that provider.
     */
    public function testGet()
    {
        $provider = $this->getSunlightCongressProvider();
        
        $this->furryBear->registerProvider($provider);
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $this->furryBear->registerOutput($output);
        
        // Let's get a new resource
        $resourceName = 'bills';
        $expectedClass = '\\FurryBear\\Resource\\SunlightCongress\\Bills';
        
        $this->assertAttributeInternalType('array', 'data', $this->furryBear);
        $this->assertAttributeEmpty('data', $this->furryBear);
        
        $this->furryBear->{$resourceName};
        
        $this->assertAttributeNotEmpty('data', $this->furryBear);
        $this->assertArrayHasKey($resourceName, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        $this->assertAttributeContainsOnly($expectedClass, 'data', $this->furryBear);
        $this->assertCount(1, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        
        // Does the resource get reused?
        $this->furryBear->{$resourceName};
        
        $this->assertAttributeNotEmpty('data', $this->furryBear);
        $this->assertArrayHasKey($resourceName, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        $this->assertAttributeContainsOnly($expectedClass, 'data', $this->furryBear);
        $this->assertCount(1, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        
        // Does a resource name with underscore get translated to a resource correctly?
        // Do we have 2 cached resources now?
        $resourceName2 = 'legislators_locate';
        $expectedClass2 = '\\FurryBear\\Resource\\SunlightCongress\\LegislatorsLocate';
        
        $this->furryBear->{$resourceName2};
        
        $data = \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data');
        
        $this->assertAttributeNotEmpty('data', $this->furryBear);
        $this->assertArrayHasKey($resourceName2, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        $this->assertCount(2, \PHPUnit_Framework_Assert::readAttribute($this->furryBear, 'data'));
        $this->assertInstanceOf($expectedClass2, $data[$resourceName2]);
    }
}