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

namespace FurryBear\Tests\Output\Strategy\Error;

/**
 * Test for Json Error
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class JsonTest extends \PHPUnit_Framework_TestCase
{
    protected $output;
    
    /**
     * Set up fixtures
     */
    protected function setUp()
    {
        $this->output = new \FurryBear\Output\Strategy\JsonToObject();
    }
    
    /**
     * Clean up after each test
     */
    protected function tearDown()
    {
        unset($this->output);
    }
    
    /**
     * Test for JSON_ERROR_SYNTAX
     */
    public function testJsonErrorSyntax()
    {
        $data = '"in_office": true}';
        
        try {
            $this->output->convert($data);
        } catch (\FurryBear\Exception\InvalidJsonException $e) {
            $this->setExpectedException('\\FurryBear\\Exception\\InvalidJsonException', 'Invalid json');
            throw new \FurryBear\Exception\InvalidJsonException('Invalid json');
        }
    }
}