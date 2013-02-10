<?php

/**
 * Test for SplClassLoader
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 */
class SplClassLoaderTest extends PHPUnit_Framework_TestCase {
    
    /**
     * Test to ensure the loader autoloads the needed classes.
     */
    public function testClassLoad() {
        $this->assertInstanceOf('Furrybear\FurryBear', 
                                new \FurryBear\FurryBear());
    }
    
    /**
     * Test to ensure the autoload function is registered.
     */
    public function testSplRegister() {
        $spl_autoload_functions = spl_autoload_functions();
        
        foreach($spl_autoload_functions as $f) {
            if(is_array($f) && $f[0] instanceof SplClassLoader) {
                $this->assertEquals($f[1], 'loadClass');
            }
        }
    }
}