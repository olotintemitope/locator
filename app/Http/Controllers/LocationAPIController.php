<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleClient;

class LocationAPIController extends Controller
{
	public function getCountries(GuzzleClient $client)
	{
		$res = $client->request('GET', 'http://where.yahooapis.com/v1/countries?format=json&appid=' . env('YAHOO_CLIENT_ID'));
		
		return $res->getBody();
	}

	public function getStates($countryName)
	{
	}

	public function getCounties($stateName)
	{
	}
}