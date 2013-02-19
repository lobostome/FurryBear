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

namespace FurryBear\Tests\View;

/**
 * Test for JsonToObjectViewStrategy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class JsonToObjectViewStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the json gets converted to an object.
     */
    public function testOutput()
    {
        $data = '{"in_office": true}';
        
        $view = new \FurryBear\View\JsonToObjectViewStrategy();
        $obj = $view->output($data);
        
        $this->assertInternalType('object', $obj);
        $this->assertTrue($obj->in_office);
    }
}