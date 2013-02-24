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
     * Test curl return content.
     */
    public function testGetContent()
    {
        $headers = array("Cache-Control: no-cache, must-revalidate",
                         "Expires: Sat, 26 Jul 1997 05:00:00 GMT");
        
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        
        $curlAdapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        $curlAdapter->setHeaders($headers);

        $this->assertNull($curlAdapter->getContent('http://example.com'));
    }
    
    /**
     * Test curl return an exception.
     */
    public function testGetContentException()
    {
        // Things to do
        // 1. Set $this->proxy == null
        // 2. make $this->proxy->execute() == false
        // 3. Handle exception
        
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $curlProxy->expects($this->any())
                  ->method('execute')
                  ->will($this->returnValue(false));
        $curlAdapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        try {
            $curlAdapter->getContent('http://example.com');
        } catch (\FurryBear\Exception\NoResultException $e) {
            $this->setExpectedException('\\FurryBear\\Exception\\NoResultException');
            throw new \FurryBear\Exception\NoResultException();
        }
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
        
        $this->assertObjectHasAttribute('headers', $curlAdapter);
        $this->assertAttributeInternalType('array', 'headers', $curlAdapter);
        $this->assertAttributeNotEmpty('headers', $curlAdapter);
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
        
        $this->assertObjectHasAttribute('userAgent', $curlAdapter);
        $this->assertAttributeInternalType('string', 'userAgent', $curlAdapter);
        $this->assertAttributeNotEmpty('userAgent', $curlAdapter);
        $this->assertAttributeEquals('FurryBear via cURL', 
                                     'userAgent',
                                     $curlAdapter);
    }
}