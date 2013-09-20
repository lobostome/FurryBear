FurryBear
---------

A PHP wrapper for the Sunlight Foundation APIs

Quick Start
-----------
You can start quickly with minimal setup by using the DI container and Composer.
It has set as default a cURL connection to the Sunlight Congress API that 
outputs the result as an array.

```php
require 'vendor/autoload.php';

use FurryBear\FurryBearContainer;

$container = new FurryBearContainer();
$container['apikey'] = 'Your Sunlight Foundation API Key';
$searchCriteria = array('query' => '"health care" medicine');

var_dump($container['furrybear']->bills_search->get($searchCriteria));
```

Documentation
-------------

For detailed documentation and examples, visit the [Wiki](https://github.com/lobostome/FurryBear/wiki).

Roadmap
-------
**0.9.0**
- Add Sunlight Influence Explorer API

**0.8.0**
- Major overhaul of existing code base
- Add event management
- HTTP clients direct access
- Process multiple requests in parallel
- 100% unit testing

Changelog
---------
**0.7.0**
- Add Dependency Injection Container

**0.6.0**
- Add Sunlight Political Party Time API

**0.5.2**
- Add Congress API districts locate helpers

**0.5.1**
- Alias Open States API resources
- Add Geocode Chain Provider

**0.5.0**
- Add Sunlight Open States API

**0.4.0**
- Add Sunlight Capitol Words API