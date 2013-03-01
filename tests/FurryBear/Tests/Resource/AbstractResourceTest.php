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
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $provider = new \FurryBear\Provider\Source\SunlightFoundation($adapter, $this->apiKey);
        
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
     * Test getting parameters.
     */
    public function testGetParams()
    {
        $params = array("key1" => "value1", "key2" => "value 2");
        $this->stub->setParams($params);
        
        $this->assertAttributeInternalType('array', 'params', $this->stub);
        $this->assertCount(2, $this->stub->getParams());
        $this->assertSame($params, $this->stub->getParams());
    }
    
    /**
     * Test settings parameters.
     */
    public function testSetParams()
    {
        $params = array("key1" => "value1", "key2" => "value 2");
        
        $this->assertClassHasAttribute('params', '\\FurryBear\\Resource\\AbstractResource');
        $this->assertAttributeInternalType('array', 'params', $this->stub);
        $this->assertInternalType('array', $params);
        
        $this->stub->setParams($params);
        $params_keys = array_keys($params);
        
        $this->assertAttributeInternalType('array', 'params', $this->stub);
        $this->assertArrayHasKey($params_keys[1], \PHPUnit_Framework_Assert::readAttribute($this->stub, 'params'));
        $this->assertCount(2, \PHPUnit_Framework_Assert::readAttribute($this->stub, 'params'));
    }
    
    /**
     * Test getting a result from the resource.
     */
    public function testGet()
    {
        $params = array("key1" => "value1", "key2" => "value 2");
        $this->assertNull($this->stub->get($params));
    }
}