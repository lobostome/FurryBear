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

namespace FurryBear\Tests\Proxy;

/**
 * A test for Buzz Proxy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class BuzzTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Buzz Proxy 
     */
    protected $proxy;
    
    /**
     * Set up fixtures
     */
    public function setUp()
    {
        $this->proxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Buzz')
                            ->disableOriginalConstructor()
                            ->getMock();
    }
    
    /**
     * Clean up fixtures
     */
    public function tearDown()
    {
        unset($this->proxy);
    }
    
    /**
     * Test all curl method with a stub.
     */
    public function testExecute()
    {   
        $this->assertNull($this->proxy->execute());
    }
    
    /**
     * Test get error
     */
    public function testGetError()
    {
        $this->assertNull($this->proxy->getError());
    }
    
    /**
     * Test set target url
     */
    public function testSetUrl()
    {
        $this->assertNull($this->proxy->setUrl('www.google.com'));
    }
    
    /**
     * Test set headers
     */
    public function testSetHeaders()
    {
        $this->assertNull($this->proxy->setHeaders(array()));
    }
    
    /**
     * Test unimplemented close method
     */
    public function testClose()
    {
        $this->setExpectedException('\\FurryBear\\Exception\\NotImplementedException');
        
        $this->proxy->expects($this->any())
                    ->method('close')
                    ->will($this->throwException(new \FurryBear\Exception\NotImplementedException()));
        
        $this->proxy->close();
    }
    
    /**
     * Test unimplemented getInfo method
     */
    public function testGetInfo()
    {
        $this->setExpectedException('\\FurryBear\\Exception\\NotImplementedException');
        
        $this->proxy->expects($this->any())
                    ->method('getInfo')
                    ->will($this->throwException(new \FurryBear\Exception\NotImplementedException()));
        
        $this->proxy->getInfo();
    }
    
    /**
     * Test unimplemented setOption method
     */
    public function testSetOption()
    {
        $this->setExpectedException('\\FurryBear\\Exception\\NotImplementedException');
        
        $this->proxy->expects($this->any())
                    ->method('setOption')
                    ->will($this->throwException(new \FurryBear\Exception\NotImplementedException()));
        
        $this->proxy->setOption('name', 'value');
    }
}