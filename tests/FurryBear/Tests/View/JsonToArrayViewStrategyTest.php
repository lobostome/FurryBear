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
 * Test for JsonToArrayViewStrategy.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class JsonToArrayViewStrategyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * Test the json gets converted to an array.
     */
    public function testOutput()
    {
        $data = '{"in_office": true}';
        
        $view = new \FurryBear\View\JsonToArrayViewStrategy();
        
        $this->assertInternalType('array', $view->output($data));
        $this->assertArrayHasKey('in_office', $view->output($data));
    }
}