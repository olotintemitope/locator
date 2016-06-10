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

$app->group(['prefix' => '/api/v1'], function() use ($app) {
    $app->get('/countries', 'App\Http\Controllers\LocationAPIController@getCountries');

    $app->get('/states/{countryName}', 'App\Http\Controllers\LocationAPIController@getStates');

    $app->get('/counties/{stateName}', function() {
        return 'Return list of Local Governemt under a state as a JSON response';
    });
});