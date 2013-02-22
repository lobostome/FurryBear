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

namespace FurryBear\Tests;

/**
 * Test for FurryBear.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class FurryBearTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    /**
     * Set up fixtures.
     */
    protected function setUp()
    {
        $this->furryBear = new \FurryBear\FurryBear();
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
    }
    
    /**
     * Test setting a concrete provider.
     */
    public function testRegisterProvider()
    {
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $provider = $this->getMockBuilder('\FurryBear\Provider\AbstractProvider')
                         ->setConstructorArgs(array($adapter))
                         ->getMock();
        
        $this->furryBear->registerProvider($provider);
        
        $this->assertNotNull($provider);
        $this->assertInstanceOf('\FurryBear\Provider\AbstractProvider', $provider);
        $this->assertObjectHasAttribute('provider', $this->furryBear);
        $this->assertAttributeSame($provider, 'provider', $this->furryBear);
    }
    
    /**
     * Test getting a concrete provider.
     */
    public function testGetProvider()
    {
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $provider = $this->getMockBuilder('\FurryBear\Provider\AbstractProvider')
                         ->setConstructorArgs(array($adapter))
                         ->getMock();
        
        $this->furryBear->registerProvider($provider);
        
        $this->assertNotNull($provider);
        $this->assertInstanceOf('\FurryBear\Provider\AbstractProvider', $provider);
        $this->assertObjectHasAttribute('provider', $this->furryBear);
        $this->assertAttributeSame($this->furryBear->getProvider(), 'provider', $this->furryBear);
    }
    
    /**
     * Test setting an output format.
     */
    public function testRegisterOutput()
    { 
        $output = new \FurryBear\Output\JsonToObjectOutputStrategy();
        $this->furryBear->registerOutput($output);
        
        $this->assertNotNull($output);
        $this->assertInstanceOf('\FurryBear\Output\JsonToObjectOutputStrategy', $output);
        $this->assertObjectHasAttribute('output', $this->furryBear);
        $this->assertAttributeSame($output, 'output', $this->furryBear);
    }
    
    /**
     * Test getting the output format.
     */
    public function testGetOutput()
    {
        $output = new \FurryBear\Output\JsonToObjectOutputStrategy();
        $this->furryBear->registerOutput($output);
        
        $this->assertNotNull($output);
        $this->assertInstanceOf('\FurryBear\Output\JsonToObjectOutputStrategy', $output);
        $this->assertObjectHasAttribute('output', $this->furryBear);
        $this->assertAttributeSame($this->furryBear->getOutput(), 'output', $this->furryBear);
    }
    
    /**
     * Test getting the library version.
     */
    public function testGetVersion()
    {
        $this->assertEquals(\FurryBear\FurryBear::VERSION, $this->furryBear->getVersion());
    }
}