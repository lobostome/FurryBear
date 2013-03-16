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
 * Test for XmlToObject output strategy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class XmlToObjectTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the xml gets converted to an object.
     */
    public function testConvert()
    {
        $data = '<?xml version="1.0"?><root><bill id="abc-113"></bill></root>';
        
        $output = new \FurryBear\Output\Strategy\XmlToObject();
        $obj = $output->convert($data);
        
        $this->assertInternalType('object', $obj);
        $this->assertObjectHasAttribute('bill', $obj);
        $this->assertInstanceOf('\\SimpleXMLElement', $obj->bill);
    }
    
    /**
     * Test the invalid xml exception.
     */
    public function testInvalidXmlOutput()
    {
        $data = '<?xml version="1.0"?><root><bill id="abc-113"></root>';
        $output = new \FurryBear\Output\Strategy\XmlToObject();
        
        try {
            $output->convert($data);
        } catch (\FurryBear\Exception\InvalidXmlException $e) {
            $this->setExpectedException('\\FurryBear\\Exception\\InvalidXmlException', 'Invalid xml');
            throw new \FurryBear\Exception\InvalidXmlException('Invalid xml');
        }
    }
}