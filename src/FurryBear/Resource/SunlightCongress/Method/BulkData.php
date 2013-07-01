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

namespace FurryBear\Resource\SunlightCongress\Method;

use FurryBear\Common\Exception\NotImplementedException,
    FurryBear\Resource\SunlightCongress\BaseResource;

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
     * A URL for a CSV of basic legislator information
     */
    const LEGISLATORS_SPREADSHEET = 'https://raw.github.com/sunlightlabs/apidata/master/legislators/legislators.csv';
    
    /**
     * A URL for a CSV connecting Zip Code Tabulation Areas (ZCTAs) to congressional districts 
     */
    const ZIP_TO_DISTRICT = 'http://assets.sunlightfoundation.com/data/districts.csv';
    
    /**
     * A URL for a zip file of official photos of members of Congress, size 40x50
     */
    const LEGISLATORS_PHOTOS_SMALL = 'http://assets.sunlightfoundation.com/moc/40x50.zip';
    
    /**
     * A URL for a zip file of official photos of members of Congress, size 100x125
     */
    const LEGISLATORS_PHOTOS_MEDIUM = 'http://assets.sunlightfoundation.com/moc/100x125.zip';
    
    /**
     * A URL for a zip file of official photos of members of Congress, size 200x250
     */
    const LEGISLATORS_PHOTOS_LARGE = 'http://assets.sunlightfoundation.com/moc/200x250.zip';
    
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
     * @return \FurryBear\Resource\SunlightCongress\BulkData
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
    
    /**
     * Download a CSV of basic legislator information
     * 
     * @return void
     */
    public function downloadLegislatorSpreadsheet()
    {
        $this->download(self::LEGISLATORS_SPREADSHEET);
    }
    
    /**
     * Download a CSV connecting Zip Code Tabulation Areas (ZCTAs) to congressional districts
     * 
     * @return void
     */
    public function downloadZipToDistrict()
    {
        $this->download(self::ZIP_TO_DISTRICT);
    }
    
    /**
     * Download a zip file of official photos of members of Congress, size 40x50
     * 
     * @return void
     */
    public function downloadLegislatorsPhotosSmall()
    {
        $this->download(self::LEGISLATORS_PHOTOS_SMALL);
    }
    
    /**
     * Download a zip file of official photos of members of Congress, size 100x125
     * 
     * @return void
     */
    public function downloadLegislatorsPhotosMedium()
    {
        $this->download(self::LEGISLATORS_PHOTOS_MEDIUM);
    }
    
    /**
     * Download a zip file of official photos of members of Congress, size 200x250
     * 
     * @return void
     */
    public function downloadLegislatorsPhotosLarge()
    {
        $this->download(self::LEGISLATORS_PHOTOS_LARGE);
    }
}