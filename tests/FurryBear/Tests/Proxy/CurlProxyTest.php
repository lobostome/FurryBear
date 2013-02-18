<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */
namespace FurryBear\Tests\Proxy;
/**
 * Test the curl proxy.
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 */
class CurlProxyTest extends \PHPUnit_Framework_TestCase {
    
    public function testCurlWrapperMethods() {
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
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