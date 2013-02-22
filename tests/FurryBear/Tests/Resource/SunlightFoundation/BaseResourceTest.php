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

namespace FurryBear\Tests\Resource\SunlightFoundation;

/**
 * A test for SunlightFoundation\BaseResource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class BaseResourceTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \FurryBear\FurryBear
     */
    protected $furryBear;
    
    /**
     * @var \FurryBear\Resource\AbstractResource
     */
    protected $stub;
    
    /**
     * @var string
     */
    protected $apiKey = 'some-api-key';

    /**
     * Set up fixtures.
     */
    protected function setUp()
    {
        $curlProxy = $this->getMockBuilder('\FurryBear\Proxy\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $provider = new \FurryBear\Provider\SunlightFoundationProvider($adapter, $this->apiKey);
        
        $output = new \FurryBear\Output\JsonToObjectOutputStrategy();
        
        $this->furryBear = new \FurryBear\FurryBear();
        $this->furryBear->registerProvider($provider)
                        ->registerOutput($output);
        
        $this->stub = $this->getMockBuilder('\FurryBear\Resource\SunlightFoundation\BaseResource')
                           ->setConstructorArgs(array($this->furryBear))
                           ->getMockForAbstractClass();
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->furryBear);
        unset($this->stub);
        unset($this->apiKey);
    }
    
    /**
     * Test building a resource location.
     */
    public function testBuildQuery()
    {
        $params_0 = array();
        $expected_with_0 = 'http://congress.api.sunlightfoundation.com/?apikey=some-api-key';
        
        $params_2 = array("congress" => 113, 
                        "history.enacted" => true);
        $expected_with_2 = 'http://congress.api.sunlightfoundation.com/?apikey=some-api-key&congress=113&history.enacted=1';
        
        $method = new \ReflectionMethod(
            '\FurryBear\Resource\SunlightFoundation\BaseResource', 'buildQuery'
        );
        $method->setAccessible(TRUE);
        
        $this->assertEquals($expected_with_0, 
                            $method->invoke($this->stub, $params_0));
        $this->assertEquals($expected_with_2, 
                            $method->invoke($this->stub, $params_2));
    }
    
    /**
     * Test getting a result from the resource.
     */
    public function testGet()
    {
        $this->assertNull($this->stub->get(array()));
    }
}