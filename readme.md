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
1. `composer require claz/locator dev-develop` 
2. In your `composer.json` file, add `require claz/locator dev-develop` 
3. In your main file require `claz/locator` 
4. and you are good to go. 
 --- 
### Using with Laravel 
If you are using this project with Laravel, follow the following steps:
1. `composer require claz/locator dev-develop` 
2. Open app.config in config folder and,
3. Register the ServiceProvider ` Wishi\Providers\LocatorServiceProvider::class `
4. and the facade  ` Locator => Wishi\Facades\Locator::class `

### Using with Yii, ZendF, CakePHP, and other PHP Frameworks 
If you are using this project with other PHP frameworks, it is easy to plugin this changes to your project main directory.

## License 
--- 
This project uses the MIT License feel free to contribute.





