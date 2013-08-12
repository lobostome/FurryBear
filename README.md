FurryBear
---------

A wrapper for Sunlight Congress API v3

Quick Start
-----------

```php
$adapter = new FurryBear\Http\Adapter\Curl();
$provider = new FurryBear\Provider\Source\SunlightCongress($adapter, $apiKey);
$output = new FurryBear\Output\Strategy\JsonToArray();

$fb = new FurryBear\FurryBear();
$fb->registerProvider($provider)->registerOutput($output);

try {
    var_dump(
            $fb->bills_search->fields('official_title', 'chamber', 'introduced_on', 'search')
                             ->search('"health care" medicine')
                             ->filter('history.enacted', true)
                             ->order('introduced_on')
                             ->order('bill_id', 'asc')
                             ->highlight('<strong>', '</strong>', 300)
                             ->page(2, 25)
                             ->explain()
                             ->get()
    );
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Documentation
-------------

For detailed documentation and examples, visit the [Wiki](https://github.com/lobostome/FurryBear/wiki).

Roadmap
-------
**0.7.0**
- Major overhaul of existing code base
- Add event management
- HTTP clients direct access
- Process multiple requests in parallel
- 100% unit testing
- Dependency Injection Container

**0.6.0**
- Add Sunlight Political Party Time API

Changelog
---------
**0.5.1**
- Alias Open States API resources
- Add Geocode Chain Provider

**0.5.0**
- Add Sunlight Open States API

**0.4.0**
- Add Sunlight Capitol Words API