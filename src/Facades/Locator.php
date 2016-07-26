<?php

namespace Wishi\Facades;

use Illuminate\Support\Facades\Facade;

class Locator extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'locator';
    }
}
