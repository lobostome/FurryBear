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

namespace FurryBear\Resource\SunlightFoundation;

use FurryBear\Exception\NotImplementedException;

/**
 * This class gives access to Sunlight Congress bulk data.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class BulkData extends BaseResource
{
    /**
     * The download directory location
     * 
     * @var string
     */
    protected $downloadDirectory;

    /**
     * Constructs the resource and sets a reference to the FurryBear object
     * 
     * @param \FurryBear\FurryBear $furryBear A reference to the FurryBear onject.
     */
    public function __construct(\FurryBear\FurryBear $furryBear)
    {
        parent::__construct($furryBear);
    }
    
    /**
     * {@inheritdoc}
     * 
     * @param array $params The search criteria.
     * 
     * @throws NotImplementedException
     */
    protected function buildQuery(array $params) {
        throw new NotImplementedException(__CLASS__ . ' does not support ' . __METHOD__);
    }
    
    /**
     * {@inheritdoc}
     * 
     * @throws NotImplementedException
     */
    public function getIterator() {
        throw new NotImplementedException(__CLASS__ . ' does not support ' . __METHOD__);
    }
    
    /**
     * Sets the download directory
     * 
     * @param string $downloadDirectory The download directory
     * 
     * @return \FurryBear\Resource\SunlightFoundation\BulkData
     */
    public function setDirectory($downloadDirectory)
    {
        if (!file_exists($downloadDirectory)) {
            throw new \Exception($downloadDirectory . ' does not exist.');
        }
        if (!is_writable($downloadDirectory)) {
            throw new \Exception($downloadDirectory . ' is not writable.');
        }
        $this->downloadDirectory = rtrim($downloadDirectory, '/\\');
        return $this;
    }
    
    /**
     * Download the file at the specified URL
     * 
     * @param string $url The target URL
     * 
     * @return void
     */
    public function download($url)
    {
        if (empty($this->downloadDirectory)) {
            throw new \Exception('You must specify a download directory');
        }
        
        $targetFile = $this->downloadDirectory . DIRECTORY_SEPARATOR . pathinfo($url, PATHINFO_BASENAME);
        
        if (file_exists($targetFile)) {
            throw new \Exception($targetFile . ' already exists and cannot be overwritten. Delete or rename that file and try again.');
        }
        
        $content = $this->furryBear->getProvider()->getAdapter()->getContent($url);
        file_put_contents($targetFile, $content);
    }
}