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
 * A test for AbstractProvider.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class AbstractProviderTest extends \PHPUnit_Framework_TestCase
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
     * @var \FurryBear\Provider\AbstractProvider 
     */
    protected $stub;

    /**
     * Set up the fixtures.
     */
    protected function setUp()
    {
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $this->adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $this->stub = $this->getMockBuilder('\FurryBear\Provider\AbstractProvider')
                           ->setConstructorArgs(array($this->adapter))
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
     * Test setting the adapter.
     */
    public function testSetAdapter()
    {
        $this->stub->expects($this->any())
                   ->method('setAdapter')
                   ->will($this->returnArgument(0));
        
        $this->assertNotNull($this->adapter);
        $this->assertInstanceOf('\FurryBear\HttpAdapter\HttpAdapterInterface', $this->adapter);
        $this->assertObjectHasAttribute('adapter', $this->stub);
        $this->assertSame($this->adapter, $this->stub->setAdapter($this->adapter));
    }
    
    /**
     * Test getting an adapter instance.
     */
    public function testGetAdapter()
    {
        $this->stub->expects($this->any())
                   ->method('getAdapter')
                   ->will($this->returnValue($this->adapter));
        
        $this->assertNotNull($this->adapter);
        $this->assertInstanceOf('\FurryBear\HttpAdapter\HttpAdapterInterface', $this->adapter);
        $this->assertObjectHasAttribute('adapter', $this->stub);
        $this->assertSame($this->adapter, $this->stub->getAdapter());
    }
}