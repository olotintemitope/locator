<?php

namespace Wishi\Controllers;

use Exception;
use Dotenv\Dotenv;
use Wishi\Model\State;
use Wishi\Model\County;
use Wishi\Model\Country;
use GuzzleHttp\Client as GuzzleClient;
use Wishi\Exceptions\RequestException;

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
		try {
			$places = $this->respondJSON($this->getter('countries'))['places']['place'];

			return $this->makeCollection($places, 'country');
			
		} catch(Exception $e) {
			throw RequestException::create($e->getCode());
		}
	}

	public function getStates($countryName)
	{
		try {
			$data = $this->respondJSON( $this->getter('states/' . $countryName));
			$places = $data['places']['place'];

			return $this->makeCollection($places, 'state');

		} catch(Exception $e) {
			throw RequestException::create($e->getCode());
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
		try {
			$data = $this->respondJSON($this->getter('counties/'.$stateName));
			$places = $data['places']['place'];

			return $this->makeCollection($places, 'county');

		} catch (Exception $e) {
			throw RequestException::create($e->getCode());
		}
	}

	/**
	 * Make a collection of model instances.
	 * 
	 * @param  An array containing information of each location.
	 * @param  The name of the model class.
	 * 
	 * @return Illuminate\Support\Collection
	 */
	private function makeCollection($places, $model)
	{
		$class = 'Wishi\Model\\' . ucwords($model);

		return collect(array_map(function ($place) use($class) {
			return new $class($place);
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