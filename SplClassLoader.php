<?php

/**
 * SplClassLoader implements the autoloader interoperability standard PSR-0.
 * 
 * Example:
 * $classLoader = new SplClassLoader(__DIR__ . '/../src');
 * $classLoader->register();
 * 
 * @author lobostome <lobostome@local.dev>
 * @package FurryBear
 * @see https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-0.md
 */
class SplClassLoader {

    private $_path = null;
    private $_namespaceSeparator = null;
    private $_fileExtension = null;

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
        spl_autoload_register(array($this, 'loadClass'));
    }

    /**
     * Loads the given class or interface.
     *
     * @param string $className The name of the class to load.
     */
    public function loadClass($className) {
        $className = ltrim($className, $this->_namespaceSeparator);
        $fileName = '';
        $namespace = '';
        if (false !== ($lastNsPos = strripos($className, $this->_namespaceSeparator))) {
            $namespace = substr($className, 0, $lastNsPos);
            $className = substr($className, $lastNsPos + 1);
            $fileName = str_replace('\\', DIRECTORY_SEPARATOR, $namespace) . DIRECTORY_SEPARATOR;
        }
        $fileName .= str_replace('_', DIRECTORY_SEPARATOR, $className) . $this->_fileExtension;

        require ($this->_path !== null ? $this->_path . DIRECTORY_SEPARATOR : '') . $fileName;
    }
}