<?php

namespace App\Controllers;

use App\Model\County;
use App\Model\Country;
use Dotenv\Dotenv as Dotenv;
use GuzzleHttp\Client as GuzzleClient;

class LocationAPIController
{
	/**
	 * The GuzzleClient instance to-be.
	 */
	protected $client;
	protected $dotenv;

	const API_URL = 'http://where.yahooapis.com/v1/';

	const API_ATT = '?format=json&appid=';

	private $countries = [];

	/**
	 * Create an instance of Guzzle
	 */
	public function __construct(GuzzleClient $client, Dotenv $dotenv)
	{
		$this->client = $client;

		$this->dotenv = $dotenv;
		$dotenv->load();

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
		$response = $this->getter('states/' . $countryName);

		return $this->respondJSON($res);
	}

	/**
	 * This method gets all counties under a state.
	 *
	 * @param $stateName
	 *
	 * @return collection
	 */
	public function getCounties($stateName)
	{
		$data = $this->respondJSON($this->getter('counties/'.$stateName))['places']['place'];

		return collect(array_map(function ($county) {
			return new County($county);
		}, $data));
	}

	/**
	 * Make a request with Guzzle Client
	 *
	 * @return Guzzle response
	 */
	private function getter ($string)
	{
		return $this->client->request('GET', self::API_URL . $string . self::API_ATT . getenv('YAHOO_CLIENT_ID'));
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