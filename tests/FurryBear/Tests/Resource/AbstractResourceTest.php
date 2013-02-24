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

namespace FurryBear\Tests\Resource;

/**
 * A test for AbstractResource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class AbstractResourceTest extends \PHPUnit_Framework_TestCase
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
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\CurlProxy')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\HttpAdapter\CurlHttpAdapter($curlProxy);
        
        $provider = new \FurryBear\Provider\SunlightFoundationProvider($adapter, $this->apiKey);
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        
        $this->furryBear = new \FurryBear\FurryBear();
        $this->furryBear->registerProvider($provider)
                        ->registerOutput($output);
        
        $this->stub = $this->getMockBuilder('\\FurryBear\\Resource\\AbstractResource')
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
     * Test getting a resource method.
     * 
     * @requires PHP 5.3.2
     */
    public function testGetResourceMethod()
    {
        // Initial state when no value set for resourceMethod
        $methodGet = new \ReflectionMethod(
            '\FurryBear\Resource\AbstractResource', 'getResourceMethod'
        );
        $methodGet->setAccessible(TRUE);
        
        $this->assertClassHasAttribute('resourceMethod', '\\FurryBear\\Resource\\AbstractResource');
        $this->assertAttributeEmpty('resourceMethod', $this->stub);
        $this->assertAttributeEquals($methodGet->invoke($this->stub), 'resourceMethod', $this->stub);
        
        // Set resourceMethod to a value and then check method again.
        $resourceMethod = 'bills';
        
        $methodSet = new \ReflectionMethod(
            '\\FurryBear\\Resource\\AbstractResource', 'setResourceMethod'
        );
        $methodSet->setAccessible(TRUE);
        $methodSet->invoke($this->stub, $resourceMethod);
        
        $this->assertAttributeNotEmpty('resourceMethod', $this->stub);
        $this->assertAttributeEquals($resourceMethod, 'resourceMethod', $this->stub);
    }
    
    /**
     * Test setting a resource method.
     */
    public function testSetResourceMethod()
    {
        $resourceMethod = 'bills';
        
        $methodSet = new \ReflectionMethod(
            '\\FurryBear\\Resource\\AbstractResource', 'setResourceMethod'
        );
        $methodSet->setAccessible(TRUE);
        $methodSet->invoke($this->stub, $resourceMethod);
        
        $this->assertAttributeNotEmpty('resourceMethod', $this->stub);
        $this->assertAttributeEquals($resourceMethod, 'resourceMethod', $this->stub);
    }
    
    /**
     * Test getting a result from the resource.
     */
    public function testGet()
    {
        $this->assertNull($this->stub->get(array()));
    }
}