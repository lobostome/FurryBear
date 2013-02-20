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

namespace FurryBear\Tests\HttpAdapter;

/**
 * Test for CurlHttpAdapter.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class CurlHttpAdapterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test for invalid http exception.
     * 
     * @expectedException        \FurryBear\Exception\HttpException
     * @expectedExceptionMessage HTTP code: 404
     */
    public function testHttpException()
    {
        throw new \FurryBear\Exception\HttpException('HTTP code: 404');
    }

    /**
     * Test curl return with a stub.
     */
    public function testGetContent()
    {     
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $curlProxy->expects($this->any())
                    ->method('setOption')
                    ->will($this->returnValue(''));
        
        $curlAdapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        $curlAdapter->getContent('http://example.com');
    }
    
    /**
     * Test the setter for the headers.
     */
    public function testSetHeaders()
    {
        $headers = array("Cache-Control: no-cache, must-revalidate",
                         "Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        
        $curlAdapter = new \FurryBear\HttpAdapter\CurlHttpAdapter();
        $curlAdapter->setHeaders($headers);
        
        $this->assertAttributeEquals($headers, 
                                     'headers', 
                                     $curlAdapter);
    }
    
    /**
     * Test the setter for the user agent.
     */
    public function testSetUserAgent()
    {
        $curlAdapter = new \FurryBear\HttpAdapter\CurlHttpAdapter();
        $curlAdapter->setUserAgent('FurryBear via cURL');
        
        $this->assertAttributeEquals('FurryBear via cURL', 
                                     'userAgent',
                                     $curlAdapter);
    }
}