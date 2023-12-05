# fireapi-php-client

=======================

This **PHP 8.1+** library allows you to communicate with the fireapi of 24fire GmbH.

[![PHP Version Require](http://poser.pugx.org/schleyer-edv/fireapi-php-client/require/php)](https://packagist.org/packages/schleyer-edv/fireapi-php-client)
[![Latest Stable Version](http://poser.pugx.org/schleyer-edv/fireapi-php-client/v)](https://packagist.org/packages/schleyer-edv/fireapi-php-client)
[![License](http://poser.pugx.org/schleyer-edv.de/fireapi-php-client/license)](https://packagist.org/packages/schleyer-edv/fireapi-php-client)


> You can find the full API documentation [here](https://docs.fireapi.de/)!

## Getting Started

Recommended installation is using **Composer**!

In the root of your project execute the following:
```sh
$ composer require schleyer-edv/fireapi-php-client
```

Or add this to your `composer.json` file:
```json
{
    "require": {
        "schleyer-edv/fireapi-php-client": "@stable"
    }
}
```

Then perform the installation:
```sh
$ composer install --no-dev
```

### Examples

Creating the fireapi main object:
```php
<?php
// Require the autoloader
require_once 'vendor/autoload.php';

// Use the library namespace
use fireapi\fireapi;

// Then simply pass your API-Token when creating the API client object.
$client = new fireapi('API-Token');

// Then you are able to perform a request
var_dump($client->vm()->status('{vmid}'));
?>
```
