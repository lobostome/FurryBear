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

namespace FurryBear\Tests\Output\Strategy;

/**
 * Test for JsonToObject output strategy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class JsonToObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the json gets converted to an object.
     */
    public function testConvert()
    {
        $data = '{"in_office": true}';
        
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        $obj = $output->convert($data);
        
        $this->assertInternalType('object', $obj);
        $this->assertObjectHasAttribute('in_office', $obj);
        $this->assertTrue($obj->in_office);
    }
    
    /**
     * Test the invalid json exception.
     */
    public function testInvalidJsonOutput()
    {
        $data = '"in_office": true}';
        $output = new \FurryBear\Output\Strategy\JsonToObject();
        
        try {
            $output->convert($data);
        } catch (\FurryBear\Exception\InvalidJsonException $e) {
            $this->setExpectedException('\\FurryBear\\Exception\\InvalidJsonException', 'Invalid json');
            throw new \FurryBear\Exception\InvalidJsonException('Invalid json');
        }
    }
}