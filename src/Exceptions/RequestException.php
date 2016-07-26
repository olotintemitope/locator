<?php

namespace Wishi\Exceptions;

use Exception;

class RequestException extends Exception
{
    public static function create($statusCode)
    {
        $meaning = null;

        switch ($statusCode) {
            case 404:
            $meaning = 'Resource Not found';
                break;
            case 500:
            $meaning = 'Internal server error';
                break;
            default:
            $meaning = 'Oops something went wrong';
                break;
        }

        $message = ' Wishi Exception: '.$meaning.', please try again!';

        return new static($message);
    }
}
