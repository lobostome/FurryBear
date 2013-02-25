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

namespace FurryBear\Tests\Provider\Source;

/**
 * A test for SunlightFoundation provider.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class SunlightFoundationTest extends \PHPUnit_Framework_TestCase
{
    /**
     * A Http Adapter instance.
     * 
     * @var \FurryBear\HttpAdapter\HttpAdapterInterface 
     */
    protected $adapter;
    
    /**
     * A SunlightFoundation provider reference.
     * 
     * @var \FurryBear\Provider\Source\SunlightFoundation 
     */
    protected $provider;
    
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
     * The resource directory.
     * 
     * @var type 
     */
    protected $resourceDir = 'SunlightFoundation';

    /**
     * Set up the fixtures.
     */
    protected function setUp()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $this->adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $this->provider = new \FurryBear\Provider\Source\SunlightFoundation($this->adapter, $this->apiKey);
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->adapter);
        unset($this->provider);
    }
    
    /**
     * Test getting the domain URL.
     */
    public function testGetServiceUrl()
    {   
        $this->assertNotEmpty($this->serviceUrl);
        $this->assertNotEmpty($this->provider->getServiceUrl());
        $this->assertEquals($this->serviceUrl, $this->provider->getServiceUrl());
    }
    
    /**
     * Test setting an API key.
     */
    public function testSetApiKey()
    {
        $apiKey = 'another-api-key';
        $this->provider->setApiKey($apiKey);
        
        $this->assertNotEmpty($this->provider->getApiKey());
        $this->assertInternalType('string', $this->provider->getApiKey());
        $this->assertObjectHasAttribute('apiKey', $this->provider);
        $this->assertEquals($apiKey, $this->provider->getApiKey());
    }
    
    /**
     * Test getting an API key.
     */
    public function testGetApiKey()
    {   
        $this->assertNotEmpty($this->provider->getApiKey());
        $this->assertInternalType('string', $this->provider->getApiKey());
        $this->assertObjectHasAttribute('apiKey', $this->provider);
        $this->assertEquals($this->apiKey, $this->provider->getApiKey());
    }
    
    /**
     * Test setting an adapter from the concrete provider.
     */
    public function testSetAdapter()
    {
        $this->provider->setAdapter($this->adapter);
        
        $this->assertNotNull($this->adapter);
        $this->assertInstanceOf('\\FurryBear\\HttpAdapter\\HttpAdapterInterface', $this->adapter);
        $this->assertObjectHasAttribute('adapter', $this->provider);
        $this->assertSame($this->adapter, $this->provider->getAdapter());
    }
    
    /**
     * Test getting an adapter instance from a concrete provider.
     */
    public function testGetAdapter()
    {
        $this->assertNotNull($this->adapter);
        $this->assertInstanceOf('\\FurryBear\\HttpAdapter\\HttpAdapterInterface', $this->adapter);
        $this->assertObjectHasAttribute('adapter', $this->provider);
        $this->assertSame($this->adapter, $this->provider->getAdapter($this->adapter));
    }
    
    /**
     * Test getting the provider resource directory.
     */
    public function testGetResourceDir()
    {   
        $this->assertNotEmpty($this->resourceDir);
        $this->assertNotEmpty($this->provider->getDirectory());
        $this->assertEquals($this->resourceDir, $this->provider->getDirectory());
    }
}