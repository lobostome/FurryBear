<?php

/**
 * This file is part of the FurryBear package. For the full copyright and 
 * license information, please view the LICENSE file that was distributed with 
 * this source code.
 */

/**
 * SplClassLoader implements the autoloader interoperability standard PSR-0.
 * 
 * Example:
 * <code>
 * $classLoader = new SplClassLoader(__DIR__ . '/../src');
 * $classLoader->register();
 * </code>
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 * @link https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
 */
class SplClassLoader {
    
    /**
     * The path to the library.
     * 
     * @var string 
     */
    protected $_path = null;
    
    /**
     * The namespace separator string.
     * 
     * @var string
     */
    protected $_namespaceSeparator = null;
    
    /**
     * The extension of the php file.
     * 
     * @var string
     */
    protected $_fileExtension = null;

    /**
     * Creates a new SplClassLoader that loads classes of the specified 
     * path, extension, and namespace.
     * 
     * @param string $path The path to the library.
     * @param string $nsSeparator The namespace separator string.
     * @param string $ext The extension of the php file.
     */
    public function __construct($path = null, $nsSeparator = '\\', $ext = '.php') {
        $this->_path = $path;
        $this->_namespaceSeparator = $nsSeparator;
        $this->_fileExtension = $ext;
    }

    /**
     * Installs this class loader on the SPL autoload stack.
     */
    public function register() {
        spl_autoload_register(array($this, 'furrybear_autoload'));
    }

    /**
     * Loads the given class or interface.
     *
     * @param string $className The name of the class to load.
     */
    public function furrybear_autoload($className) {
        $className = ltrim($className, $this->_namespaceSeparator);
        $fileName = '';
        $namespace = '';
        if (false !== ($lastNsPos = strripos($className, $this->_namespaceSeparator))) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . $this->_fileExtension;

        $f = ($this->_path !== null ? $this->_path . DIRECTORY_SEPARATOR : '') . $fileName;
        
        if (!file_exists($f)) {
            throw new \FurryBear\Exception\FileDoesNotExistException('File does not exist ' . $f);
        }
        
        require $f;
    }
}