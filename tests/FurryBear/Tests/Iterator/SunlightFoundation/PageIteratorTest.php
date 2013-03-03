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

namespace FurryBear\Tests\Iterator\SunlightFoudnation;

/**
 * A test for Sunlight Foundation PageIterator.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */

class PageIteratorTest extends \PHPUnit_Framework_TestCase
{   
    /**
     *
     * @var \FurryBear\Iterator\SunlightFoundation\PageIterator
     */
    protected $iterator;

    /**
     * Set up fixtures.
     */
    protected function setUp()
    {
        $curlProxy = $this->getMockBuilder('\\FurryBear\\Proxy\\Curl')
                          ->disableOriginalConstructor()
                          ->getMock();
        $adapter = new \FurryBear\Http\Adapter\Curl($curlProxy);
        
        $provider = new \FurryBear\Provider\Source\SunlightFoundation($adapter, 'some-api-key');
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        
        $furryBear = new \FurryBear\FurryBear();
        $furryBear->registerProvider($provider)
                  ->registerOutput($output);
        
        $resource = $this->getMockBuilder('\\FurryBear\\Resource\\AbstractResource')
                         ->setConstructorArgs(array($furryBear))
                         ->getMockForAbstractClass();
        
        $this->iterator = new \FurryBear\Iterator\SunlightFoundation\PageIterator($resource);
    }
    
    /**
     * Clean up fixtures.
     */
    protected function tearDown()
    {
        unset($this->iterator);
    }
    
    /**
     * Test current() method
     */
    public function testCurrent()
    {
        $this->assertNull($this->iterator->current());
    }
    
    /**
     * Test key() method
     */
    public function testKey()
    {
        $this->setExpectedException('\\FurryBear\\Exception\\NotImplementedException');
        $this->iterator->key();
    }
    
    /**
     * Test next() method
     */
    public function testNext()
    {
        $params = \PHPUnit_Framework_Assert::readAttribute($this->iterator, 'params');
        $this->assertInternalType('integer', $params['page']);
        $this->assertEquals(1, $params['page']);
        
        $this->iterator->next();
        
        $params = \PHPUnit_Framework_Assert::readAttribute($this->iterator, 'params');
        $this->assertInternalType('integer', $params['page']);
        $this->assertEquals(2, $params['page']);
    }
    
    /**
     * Test rewind() method
     */
    public function testRewind()
    {
        $params = \PHPUnit_Framework_Assert::readAttribute($this->iterator, 'params');
        $this->assertInternalType('integer', $params['page']);
        $this->assertEquals(1, $params['page']);
        
        $this->iterator->next();
        
        $params = \PHPUnit_Framework_Assert::readAttribute($this->iterator, 'params');
        $this->assertInternalType('integer', $params['page']);
        $this->assertEquals(2, $params['page']);
        
        $this->iterator->rewind();
        
        $params = \PHPUnit_Framework_Assert::readAttribute($this->iterator, 'params');
        $this->assertInternalType('integer', $params['page']);
        $this->assertEquals(1, $params['page']);
    }
    
    /**
     * Test valid() method
     */
    public function testValid()
    {
        $totalPages = \PHPUnit_Framework_Assert::readAttribute($this->iterator, 'totalPages');
        $this->assertInternalType('integer', $totalPages);
        $this->assertEquals(1, $totalPages);
        $this->assertTrue($this->iterator->valid());
        
        $this->iterator->next();
        
        $this->assertFalse($this->iterator->valid());
    }
}