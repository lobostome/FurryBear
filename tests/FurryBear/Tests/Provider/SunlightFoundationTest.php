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

namespace FurryBear\Tests\Provider;

/**
 * A test for SunlightFoundationProvider.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class SunlightFoundationProviderTest extends \PHPUnit_Framework_TestCase
{
    /**
     * A Http Adapter instance.
     * 
     * @var \FurryBear\HttpAdapter\HttpAdapterInterface 
     */
    protected $adapter;
    
    /**
     * An AbstractProvider stub.
     * 
     * @var \FurryBear\Provider\SunlightFoundationProvider 
     */
    protected $stub;
    
    /**
     * A service API key.
     * 
     * @var string
     */
    protected $apiKey = 'sample-api-key';
    
    /**
     * The service domain URI.
     * 
     * @var string
     */
    protected $serviceUrl = 'http://congress.api.sunlightfoundation.com';

    /**
     * Set up the fixtures.
     */
    protected function setUp()
    {
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $this->adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $this->stub = $this->getMockBuilder('\FurryBear\Provider\SunlightFoundationProvider')
                           ->setConstructorArgs(array($this->adapter, $this->apiKey))
                           ->getMock();
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->adapter);
        unset($this->stub);
    }
    
    /**
     * Test getting the domain URL.
     */
    public function testGetServiceUrl()
    {
        $this->stub->expects($this->any())
                   ->method('getServiceUrl')
                   ->will($this->returnValue($this->serviceUrl));
        
        $this->assertNotEmpty($this->serviceUrl);
        $this->assertNotEmpty($this->stub->getServiceUrl());
        $this->assertEquals($this->serviceUrl, $this->stub->getServiceUrl());
    }
    
    /**
     * Test setting an API key.
     */
    public function testSetApiKey()
    {
        $apiKey = 'another-api-key';
        
        $this->stub->expects($this->any())
                   ->method('setApiKey')
                   ->will($this->returnArgument(0));
        
        $this->assertNotEmpty($this->stub->setApiKey($apiKey));
        $this->assertInternalType('string', $this->stub->setApiKey($apiKey));
        $this->assertObjectHasAttribute('apiKey', $this->stub);
        $this->assertEquals($apiKey, $this->stub->setApiKey($apiKey));
    }
    
    /**
     * Test getting an API key.
     */
    public function testGetApiKey()
    {
        $this->stub->expects($this->any())
                   ->method('getApiKey')
                   ->will($this->returnValue($this->apiKey));
        
        $this->assertNotEmpty($this->stub->getApiKey());
        $this->assertInternalType('string', $this->stub->getApiKey());
        $this->assertObjectHasAttribute('apiKey', $this->stub);
        $this->assertEquals($this->apiKey, $this->stub->getApiKey());
    }
}