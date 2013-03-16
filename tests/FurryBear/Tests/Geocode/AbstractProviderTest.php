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

namespace FurryBear\Tests\Geocode;

/**
 * A test for geocode AbstractProvider.
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
     * @var \FurryBear\Http\HttpAdapterInterface 
     */
    protected $adapter;
    
    /**
     * The output strategy reference
     * 
     * @var \FurryBear\Output\Strategy
     */
    protected $output;
    
    /**
     * An AbstractProvider stub.
     * 
     * @var \FurryBear\Geocode\AbstractProvider 
     */
    protected $abstractProvider;

    /**
     * Set up the fixtures.
     */
    protected function setUp()
    {
        $this->abstractProvider = $this->getMockForAbstractClass('\\FurryBear\\Geocode\\AbstractProvider');
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->adapter);
        unset($this->output);
        unset($this->abstractProvider);
    }
    
    /**
     * Test setting the adapter.
     */
    public function testSetAdapter()
    {
        $this->abstractProvider->expects($this->any())
                               ->method('setAdapter')
                               ->will($this->returnArgument(0));
        
        $this->assertObjectHasAttribute('adapter', $this->abstractProvider);
        $this->assertNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
        
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        $this->abstractProvider->setAdapter($adapter);
        
        $this->assertNotNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
        $this->assertInstanceOf('\\FurryBear\\Http\\HttpAdapterInterface', \PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
        $this->assertSame($adapter, \PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
    }
    
    /**
     * Test getting an adapter instance.
     */
    public function testGetAdapter()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $this->assertObjectHasAttribute('adapter', $this->abstractProvider);
        $this->assertNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
        $this->assertNull($this->abstractProvider->getAdapter());
        
        $this->abstractProvider->expects($this->any())
                               ->method('setAdapter')
                               ->will($this->returnArgument(0));
        $this->abstractProvider->setAdapter($adapter);
        
        $this->abstractProvider->expects($this->any())
                               ->method('getAdapter')
                               ->will($this->returnValue($adapter));
        
        $this->assertNotNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
        $this->assertInstanceOf('\\FurryBear\\Http\\HttpAdapterInterface', \PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'adapter'));
        $this->assertSame($adapter, $this->abstractProvider->getAdapter());
    }
    
    /**
     * Test setting the output.
     */
    public function testSetOutput()
    {
        $this->abstractProvider->expects($this->any())
                               ->method('setOutput')
                               ->will($this->returnArgument(0));
        
        $this->assertObjectHasAttribute('adapter', $this->abstractProvider);
        $this->assertNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $this->abstractProvider->setOutput($output);
        
        $this->assertNotNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
        $this->assertInstanceOf('\\FurryBear\\Output\Strategy', \PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
        $this->assertSame($output, \PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
    }
    
    /**
     * Test getting the output
     */
    public function testGetOutput()
    {
        $this->assertObjectHasAttribute('output', $this->abstractProvider);
        $this->assertNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
        $this->assertNull($this->abstractProvider->getOutput());
        
        $this->abstractProvider->expects($this->any())
                               ->method('setOutput')
                               ->will($this->returnArgument(0));
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $this->abstractProvider->setOutput($output);
        
        $this->abstractProvider->expects($this->any())
                               ->method('getOutput')
                               ->will($this->returnValue($output));
        
        $this->assertNotNull(\PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
        $this->assertInstanceOf('\\FurryBear\\Output\\Strategy', \PHPUnit_Framework_Assert::readAttribute($this->abstractProvider, 'output'));
        $this->assertSame($output, $this->abstractProvider->getOutput());
    }
    
    public function testGet()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        
        $this->abstractProvider->setAdapter($adapter);
        $this->abstractProvider->setOutput($output);
        
        $this->assertNull($this->abstractProvider->get('http://www.example.com'));
    }
}