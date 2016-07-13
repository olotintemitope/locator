<?php

namespace Wishi\Exceptions;

use Exception;

class ResourceNotFoundException extends Exception
{
    public static function create($countryName)
    {
        $message = ucwords($countryName).' Not found, please try again!';
        return new static($message);
    }
}