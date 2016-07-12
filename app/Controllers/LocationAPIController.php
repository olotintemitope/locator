<?php

namespace App\Controllers;

use App\Model\Country;
use GuzzleHttp\Client as GuzzleClient;

class LocationAPIController
{
	/**
	 * The GuzzleClient instance to-be.
	 */
	protected $client;

	const API_URL = 'http://where.yahooapis.com/v1/';

	const API_ATT = '?format=json&appid=';

	private $countries = [];

	/**
	 * Create an instance of Guzzle
	 */
	public function __construct(GuzzleClient $client)
	{
		$this->client = $client;

	}

	public function getCountries()
	{
		$data = $this->respondJSON($this->getter('countries'))['places']['place'];

		return collect(array_map( function ($countryData) {
			return new Country($countryData);
		}, $data));
	}

	public function getStates($countryName)
	{
		$res = $this->getter('states/' . $countryName);

		return $this->respondJSON($res);
	}

	public function getCounties($stateName)
	{

	}

	/**
	 * Make a request with Guzzle Client
	 *
	 * @return Guzzle response
	 */
	private function getter ($string)
	{
		return $this->client->request('GET', self::API_URL . $string . self::API_ATT . env('YAHOO_CLIENT_ID'));
	}

	/**
	 * Respond with Json response.
	 *
	 * @return json
	 */
	private function respondJSON($res)
	{
		return json_decode( $res->getBody(), true );
	}
}