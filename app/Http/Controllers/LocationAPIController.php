<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client as GuzzleClient;

class LocationAPIController extends Controller
{
	/**
	 * The GuzzleClient instance to-be.
	 */
	protected $client;

	/**
	 * Create an instrance on Guzzle
	 */
	public function __construct(GuzzleClient $client)
	{
		$this->client = $client;
	}

	public function getCountries()
	{
		$res = $this->client->request('GET', 'http://where.yahooapis.com/v1/countries?format=json&appid=' . env('YAHOO_CLIENT_ID'));

		return json_decode( $res->getBody(), true );
	}

	public function getStates($countryName)
	{
	}

	public function getCounties($stateName)
	{
	}
}