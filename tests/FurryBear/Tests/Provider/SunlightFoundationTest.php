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
        $this->adapter = null;
        $this->stub = null;
    }
    
    /**
     * Test getting the domain URL.
     */
    public function testGetServiceUrl()
    {
        $this->stub->expects($this->any())
                   ->method('getServiceUrl')
                   ->will($this->returnValue($this->apiKey));
                
        $this->assertEquals($this->apiKey, $this->stub->getServiceUrl());
    }
}