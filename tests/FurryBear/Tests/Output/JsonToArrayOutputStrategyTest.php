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

namespace FurryBear\Tests\Output;

/**
 * Test for JsonToArrayOutputStrategy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class JsonToArrayOutputStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the json gets converted to an array.
     */
    public function testConvert()
    {
        $data = '{"in_office": true}';
        
        $output = new \FurryBear\Output\JsonToArrayOutputStrategy();
        $array = $output->convert($data);
        
        $this->assertInternalType('array', $array);
        $this->assertArrayHasKey('in_office', $array);
        $this->assertTrue($array['in_office']);
    }
    
    /**
     * Test the invalid json exception.
     */
    public function testInvalidJsonConvert()
    {
        $data = '"in_office": true}';
        $output = new \FurryBear\Output\JsonToArrayOutputStrategy();
        
        try {
            $output->convert($data);
        } catch (\FurryBear\Exception\InvalidJsonException $e) {
            $this->setExpectedException('\\FurryBear\\Exception\\InvalidJsonException', 'Invalid json');
            throw new \FurryBear\Exception\InvalidJsonException('Invalid json');
        }
    }
}