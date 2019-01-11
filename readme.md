# Locator
---
[![Coverage Status](https://coveralls.io/repos/github/andela-tolotin/get-country-info/badge.svg?branch=develop)](https://coveralls.io/github/andela-tolotin/get-country-info?branch=develop)
[![Build Status](https://travis-ci.org/andela-tolotin/locator.svg?branch=develop)](https://travis-ci.org/andela-tolotin/locator)
[![StyleCI](https://styleci.io/repos/60624109/shield)](https://styleci.io/repos/60624109)  
If you have ever needed basic information about countries, and their states, then Locator is for you. Locator is a PHP package that works with the Yahoo API. It returns data that you need just by calling one method. There is a Service Provider and a Facade to make it easy to integrate with your Laravel project. It can also be used with other PHP frameworks like Lumen, CakePHP, Zend, etc. Version 1.0.0 only provides information about the following:
* Countries
* States in the country 
* Counties in the state
 
## Dependencies
---
* PHP 5.5+  
* Composer 1.4+
* Apache

## Getting Started 
---

To use this package with a PHP project, first require the package using composer.
```PHP
composer require claz/wishi
```

* Note that you must be registered in Yahoo as a developer. Add your Yahoo details to your environment variables.
```ENV
YAHOO_CLIENT_ID=*********************************
```
### Using plain PHP
If you are using this project with a plain PHP project, follow the following steps:

* Run `composer dumpautoload` if required.
* Require autoload.php and load the package with its dependencies.
```PHP
require_once ('vendor/autoload.php')

use Wishi\Controllers\Locator;
```
* Instantiate the Locator class and you are good to go.
```PHP
$locator = new Locator();
```
### Using with Laravel 
If you are using this project with Laravel, follow the following steps:

* Open app.config in config folder and,

* Register the ServiceProvider inside `config.php`
```PHP
Wishi\Providers\LocatorServiceProvider::class,
```
* To use the Facade, simple add it to the same file.
```PHP
Locator => Wishi\Facades\Locator::class,
```
* Import the Facade into your project.
```PHP
use Locator;
```

### Example 
--- 
* To get all the countries.
```PHP
// With normal PHP applications
$countries = $locator->getCountries();

// With the Facade in Laravel applications
$countries = Locator::getCountries();

var_dump($countries); // Collection of countries
```
* To get all the states in a country.
```PHP
// With normal PHP applications
$states = $locator->getStates('Nigeria');

// With the Facade in Laravel applications
$states = Locator::getStates('Nigeria');

var_dump($states); // Collection of states
```
* To get all the counties in a state.
```PHP
// With normal PHP applications
$counties = $locator->getCounties('Lagos');

// With the Facade in Laravel applications
$counties = Locator::getCounties('Lagos');

var_dump($counties); // Collection of counties
```

One very common use is illustrated below in a Laravel project that lists all the state in the Nigeria.
```HTML
<ul>
@foreach(Locator::getStates('Nigeria') as $state)
    <li> {{ $state->name }} </li>
@endforeach
</ul>
```

## License 
--- 
This project uses the MIT License feel free to contribute.
