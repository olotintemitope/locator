<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});

$app->group(['prefix' => '/api/v1'], function() use ($app) {
    $app->get('/countries', function() {
        return 'Return list of countries in the world as a JSON response';
    });

    $app->get('/states/{countryName}', function() {
        return 'Return list of states under a country as a JSON response';
    });

    $app->get('/counties/{stateName}', function() {
        return 'Return list of Local Governemt under a state as a JSON response';
    });
});