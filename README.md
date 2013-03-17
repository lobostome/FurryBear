FurryBear
---------

A wrapper for Sunlight Congress API v3

Installation
------------

Use the provided SplClassLoader to register furrybear_autoload function as 
__autoload() implementation

```php
require_once 'SplClassLoader.php';

// Instantiate the SplClassLoader with the location directory of the source files.
$classLoader = new SplClassLoader(__DIR__ . '/src');
$classLoader->register();
```

Workflow
--------

- Create a new http adapter instance. Http\Adapter\Curl is a very basic http 
client and is the only http adapter currently. Future releases will include 
[Guzzle](http://guzzlephp.org/) and [Buzz](https://github.com/kriswallsmith/Buzz).

```php
$adapter = new FurryBear\Http\Adapter\Curl();
```
- Create a new API provider instance and pass the adapter instance to it. Currently, 
the only provider is the Sunlight Foundation Congress API. The second parameter 
is the API key, if such is required by the API provider.

```php
$provider = new FurryBear\Provider\Source\SunlightFoundation($adapter, $apiKey);
```

- Create an instance for the output strategy. Sunlight Foundation API results 
are in json format. The latter has two strategies that can return a result as an 
array or as an object.

```php
$output = new FurryBear\Output\Strategy\JsonToArray();
```

- Create the entry point class instance and register the provider and the output 
strategy with it.

```php
$fb = new FurryBear\FurryBear();
$fb->registerProvider($provider)
   ->registerOutput($output);
```

- Now we are ready to access some of the resources. The various Sunlight 
Foundation Congress API methods can be accessed via properties of the 
FurryBear\FurryBear object. The methods are mapped to the properties with the 
following rules:
  1. No beginning slash. Example: **/legislators** becomes **legislators**.
  2. If there are two words separated by slash, replace the slash with an underscore. 
     Example: **/legislators/locate** becomes **legislators_locate**
  3. If there are two words separated by underscore, there is no change. Example: 
     **/floor_updates** becomes **floor_updates**.

The following example demonstrates a request with full text search (query), 
partial response (fields), pagination (per_page, page), and highlighting (highlight). 
The parameters are passed using the setParams() method.

```php
$params1 = array('query'           => '"health care" medicine',
                 'history.enacted' => true,
                 'fields'          => 'official_title,chamber,introduced_on,search',
                 'highlight'       => true,
                 'per_page'        => 25,
                 'page'            => 2);

try {
    $fb->bills_search->setParams($params1);
    var_dump($fb->bills_search->get());
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Here is another example that demonstrates filtering, passing the request 
parameters directly to the get() method, and more explicit exceptions.

```php
$params2 = array('last_name'    => 'Smith',
                 'fields'       => 'first_name,last_name,state,title',
                 'order'        => 'state__asc,first_name__asc');

try {

    var_dump($fb->legislators->get($params2));

} catch (FurryBear\Exception\NoProviderException $e) {
    echo $e->getMessage();
} catch (FurryBear\Exception\NoOutputException $e) {
    echo $e->getMessage();
} catch (FurryBear\Exception\NoResultException $e) {
    echo $e->getMessage();
} catch (FurryBear\Exception\FileDoesNotExistException $e) {
    echo $e->getMessage();
}
```

Page Iteration
--------------

The library provides a convenient interface to iterate over the result pages.

Here is a **foreach** example that will go over **ALL** results and output them.

```php
$params = array('query'     => 'committee of the whole',
                'chamber'   => 'house');

try {
    $fb->floor_updates->setParams($params);
    foreach ($fb->floor_updates as $page) {
        var_dump($page);
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Here is another way to do the above using **while**.

```php
$params = array('query'     => 'committee of the whole',
                'chamber'   => 'house');

try {
    $fb->floor_updates->setParams($params);
    $it = $fb->floor_updates->getIterator();
    while($it->valid()) {
        var_dump($it->current());
        $it->next(); // How ugly that is..., but necessary
    }
} catch (\Exception $e) {
    echo $e->getMessage();
}
```

Documentation
-------------

The documentation is located in the build/api directory. For a graphical view of 
the class diagram see build/api/classes.png.

Unit tests coverage
-------------------

The coverage report is located in the build/coverage directory.

To run the phpunit tests, switch to tests directory and execute:

```bash
$ phpunit .
```

Issues
------

If you find a bug, I'd love to hear about it. Report new Issues on the Issues page.

License
-------

FurryBear is released under the MIT License. See the bundled LICENSE.md file for 
details.