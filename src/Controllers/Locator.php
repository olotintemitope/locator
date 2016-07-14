<?php

namespace Wishi\Controllers;

use Exception;
use Dotenv\Dotenv;
use Wishi\Model\State;
use Wishi\Model\County;
use Wishi\Model\Country;
use GuzzleHttp\Client as GuzzleClient;
use Wishi\Exceptions\ResourceNotFoundException;

class Locator
{
	/**
	 * The GuzzleClient instance to-be.
	 */
	protected $client;

	const API_URL = 'http://where.yahooapis.com/v1/';

	const API_ATT = '?format=json&appid=';

	/**
	 * Create an instance of Guzzle
	 */
	public function __construct(GuzzleClient $client, Dotenv $dotenv)
	{
		$this->client = $client;

		$dotenv->load();
	}

	public function getCountries()
	{
		$data = $this->respondJSON($this->getter('countries'))['places']['place'];

		return collect(array_map( function ($countryData) {
			return new Country($countryData);
		}, $data));
	}

	public function getStates($stateName)
	{
		try {
			$data = $this->respondJSON( $this->getter('states/' . $stateName));
			$places = $data['places']['place'];

			return collect(array_map( function ($data) {
				return new State($data);
			}, $places));

		} catch(Exception $e) {
			throw ResourceNotFoundException::create($e->getCode());
		}
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