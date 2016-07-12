<?php

namespace Wishi\Controllers;

use Wishi\Model\County;
use Wishi\Model\Country;
use Wishi\Model\State;
use Dotenv\Dotenv as Dotenv;
use GuzzleHttp\Client as GuzzleClient;

class Locator
{
	/**
	 * The GuzzleClient instance to-be.
	 */
	protected $client;
	protected $dotenv;

	const API_URL = 'http://where.yahooapis.com/v1/';

	const API_ATT = '?format=json&appid=';

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
		$data = $this->respondJSON( $this->getter('states/' . $countryName));

		$places = $data['places']['place'];

		return collect(array_map( function ($data) {
			return new State($data);
		}, $places));
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
		$data = $this->respondJSON($this->getter('counties/'.$stateName));

		$places = $data['places']['place'];

		return collect(array_map(function ($county) {
			return new County($county);
		}, $places));
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