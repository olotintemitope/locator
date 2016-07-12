<?php

namespace Wishi\ServiceProvider;

use Dotenv\Dotenv as Dotenv;
use Wishi\Controllers\Locator;
use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\ServiceProvider;

class LocatorServiceProvider extends ServiceProvider
{
    /**
     * [$defer description]
     * @var boolean
     */
    protected $defer = false;

    /**
     * Register application service here.
     *
     * @param void
     * @return Locator
     */
    public function register()
    {
        $this->app->singleton('locator', function (GuzzleClient $client, Dotenv $dotenv) {
            return new Locator($client, $dotenv);
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @param void
     *
     * @return array
     */
    public function provides() : array
    {
        return ['locator'];
    }
}