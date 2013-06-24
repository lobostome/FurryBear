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

namespace FurryBear\Resource\SunlightCongress;

use FurryBear\Resource\AbstractResource,
    FurryBear\Iterator\SunlightCongress\PageIterator,
    FurryBear\Exception\InvalidArgumentException;

/**
 * A base presentation of SunlightCongress resource.
 * 
 * @category Congress_API
 * @package  FurryBear
 * @author   lobostome <lobostome@local.dev>
 * @license  http://opensource.org/licenses/MIT MIT License
 * @link     https://github.com/lobostome/FurryBear
 */
class BaseResource extends AbstractResource
{
    /**
     * Construct a resource with a FurryBear instance.
     * 
     * @param \FurryBear\FurryBear $furryBear A FurryBear instance.
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
     * @return string
     */
    protected function buildQuery(array $params)
    {
        $apiKey = array();
        if (method_exists($this->furryBear->getProvider(), 'getApiKey')) {
            $apiKey['apikey'] = $this->furryBear->getProvider()->getApiKey();
        }
        
        // convert booleans to string representation
        array_walk ($params, function(&$item, $key) {
                if (is_bool($item)) {
                    $item = ($item) ? 'true' : 'false';
                }
            }
        );
        
        return $this->furryBear->getProvider()->getServiceUrl() 
               . '/' .
               $this->getResourceMethod() 
               . '?' .
               http_build_query(array_merge($apiKey, $params));
    }

    /**
     * Gets an iterator that can iterate over multiple result pages.
     * 
     * @return \FurryBear\Iterator\SunlightCongress\PageIterator
     */
    public function getIterator()
    {
        return new PageIterator($this);
    }
    
    /**
     * Specifies the fields to return
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     */
    public function fields()
    {
        $params = array('fields' => implode(',', func_get_args()));
        $this->setParams($params);
        return $this;
    }
    
    /**
     * Filter on fields with a key/value pair
     * 
     * @param string $field    The key to filter by
     * @param string $value    The value of the key
     * @param string $operator An optional operator
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     * 
     * @throws InvalidArgumentException
     */
    public function filter($field, $value, $operator = '')
    {
        $allowedOperators = array('gt', 'gte', 'lt', 'lte', 'not', 'all', 'in', 'nin', 'exists');
        
        if (!empty($operator) && !in_array($operator, $allowedOperators)) {
            throw new InvalidArgumentException('Operator ' . $operator . ' is invalid.');
        }
        
        $field = empty($operator) ? $field : $field . '__' . $operator;
        
        $this->setParams(array($field => $value));
        return $this;
    }
    
    /**
     * Specify the order of the result
     * 
     * @param string $field     The field to order by
     * @param string $direction The order direction: asc or desc
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     * 
     * @throws InvalidArgumentException
     */
    public function order($field, $direction = 'desc')
    {
        $allowedDirections = array('asc', 'desc');
        $direction = strtolower($direction);
        
        if (!in_array($direction, $allowedDirections)) {
            throw new InvalidArgumentException('Sorting direction is either "asc" or "desc"');
        }
        
        $value = $field . '__' . $direction;
        
        if (array_key_exists('order', $this->params)) {
            $this->params['order'] .= ",{$value}";
        } else {
            $this->params['order'] = $value;
        }
        
        return $this;
    }
    
    /**
     * Set search query parameter
     * 
     * @param string $query The search query
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     */
    public function search($query)
    {
        $this->setParams(array('query' => $query));
        return $this;
    }
    
    /**
     * Turn on how the API interpreted the query, and database-specific explain 
     * information
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     */
    public function explain()
    {
        $this->setParams(array('explain' => true));
        return $this;
    }
    
    /**
     * Turn on highlighted excerpts for search
     * 
     * @param string  $startTag 
     * @param string  $endTag
     * @param integer $size
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     */
    public function highlight($startTag = '<em>', $endTag = '</em>', $size = 200)
    {
        $this->setParams(array(
                            'highlight'      => true,
                            'highlight.tags' => $startTag . ',' . $endTag,
                            'highlight.size' => $size
            )
        );
        
        return $this;
    }
    
    /**
     * Control result pagination
     * 
     * @param int $number Page number
     * @param int $size   Results per page
     * 
     * @return \FurryBear\Resource\SunlightCongress\BaseResource
     */
    public function page($number = 1, $size = 20)
    {
        $this->setParams(array(
                'page'     => (int)$number,
                'per_page' => (int)$size
            )
        );
        
        return $this;
    }
}