<?php

namespace Wishi\Providers;

use Wishi\Controllers\Locator;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;

class LocatorServiceProvider extends ServiceProvider
{
    /*
    * Indicates if loading of the provider is deferred.
    *
    * @var bool
    */
    protected $defer = false;

    /**
    * Publishes all the config file this package needs to function
    */
    public function boot()
    {
        $config = realpath(__DIR__.'/../resources/config/locator.php');

        $this->publishes([
            $config => config_path('etextmail.php')
        ]);
    }

    /**
     * Register application service here.
     *
     * @param void
     * @return Locator
     */
    public function register()
    {
        $this->app->singleton('locator', function ($app) {
            $client = new GuzzleClient;
           
           return new Locator($client);

       });
    }

    /**
     * Get the services provided by the provider.
     *
     * @param void
     *
     * @return array
     */
    public function provides()
    {
        return ['locator'];
    }
}