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
 * A test for CurlProxy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class CurlTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test all curl method with a stub.
     */
    public function testCurlWrapperMethods()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        
        $curlProxy->expects($this->any())
                    ->method('close')
                    ->will($this->returnValue(NULL));
        
        $curlProxy->expects($this->any())
                    ->method('execute')
                    ->will($this->returnValue(array()));
        
        $curlProxy->expects($this->any())
                    ->method('getInfo')
                    ->will($this->returnValue(200));
        
        $curlProxy->expects($this->any())
                    ->method('setOption')
                    ->will($this->returnArgument(1));
        
        $this->assertNull($curlProxy->close());
        $this->assertEmpty($curlProxy->execute());
        $this->assertEquals(200, $curlProxy->getInfo(CURLINFO_HTTP_CODE));
        $this->assertEquals(1, $curlProxy->setOption(CURLOPT_VERBOSE, 1));
    }
}