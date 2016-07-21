# Locator
---
Locator package leveraged on Yahoo places API to help developers ease the stress of getting information about places around the world. It is a PHP project that provides a rich RESTFUL API for developers around the world. information such as 
* Countries, 
* States in the country 
* Counties in the state
 
## Dependencies
--- 
* PHP 5+ or >  
* Composer 1.4. * or > 
* Apache/Nginx/HHVM

## Getting Started 
---
### Using plain PHP
If you are using this project with a plain PHP project, follow the following steps:

* On your terminal run `composer require claz/locator dev-develop` 

* Load autoload.php from vendor folder `require_once('vendor/autoload.php');` 

* then load package `use Wishi\Controllers\Locator;`  and Also your Guzzle Client `use GuzzleHttp\Client as GuzzleClient;`
 and Dotenv `use Dotenv\Dotenv as Dotenv;`

* and you are good to go. 

### Example 

- To get all the countries in the world.

<?php require_once('vendor/autoload.php');
    use Dotenv\Dotenv as Dotenv;
    use GuzzleHttp\Client as GuzzleClient;
    use Wishi\Controllers\Locator;

    $client = new GuzzleClient();
    $dotenv = new Dotenv(__DIR__);

    $locator = new Locator($client, $dotenv);

    try {
        print_r($locator->getCountries());
    } catch (Wishi\Exceptions\RequestException $e) {
        echo $e->getMessage();
    }

-  To get states under a country just call the getStates method and pass the country name as an argument

`
    <?php
        print_r($locator->getStates('Nigeria'));
`

- To get all counties/Local Government under a state, pass the name of the state as an argument to getCouties method.

`
    <?php
        print_r($locator->getCounties('Nigeria'));
`

--- 
### Using with Laravel 
If you are using this project with Laravel, follow the following steps:

* `composer require claz/locator dev-develop` 

* Open app.config in config folder and,

* Register the ServiceProvider ` Wishi\Providers\LocatorServiceProvider::class `

* and the facade  ` Locator => Wishi\Facades\Locator::class `

### Using with Yii, ZendF, CakePHP, and other PHP Frameworks 
If you are using this project with other PHP frameworks, it is easy to plugin this changes to your project main directory.

## License 
--- 
This project uses the MIT License feel free to contribute.





