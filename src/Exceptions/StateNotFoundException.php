<?php

namespace Wishi\Exceptions;

use Exception;

class StateNotFoundException extends Exception
{
    public static function create($countryName)
    {
        $message = ucwords($countryName).' Not found, please check lists of Counties! ';
        return new static($message);
    }
}