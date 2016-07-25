<?php

namespace Wishi\Controllers;

use GuzzleHttp\Client as GuzzleClient;
use Illuminate\Support\Facades\Config;

class BaseController
{
	/**
	 * The GuzzleClient instance to-be.
	 */
	protected $client;

	const API_URL = 'http://where.yahooapis.com/v1/';

	const API_ATT = '?format=json&appid=';

	/**
	 * Create instances of Guzzle
     * Load Environment
	 */
	public function __construct(GuzzleClient $client = null)
	{
		$this->client = $client == null ? new GuzzleClient() : $client;
	}

	/**
	 * Make a request with Guzzle Client
	 *
	 * @param $string
	 * @return Guzzle response
	 */
	private function getter ($string)
	{
		try {
			return $this->client->request('GET', self::API_URL . $string . self::API_ATT . Config::get('locator.client_id'));
		} catch (Exception $e) {
			throw RequestException::create($e->getCode());
		}
	}

	/**
	 * Respond with Json response.
	 *
	 * @return json
	 */
	private function respondJSON($res)
	{
		return json_decode($res->getBody(), true );
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
	 * Output data
	 * 
	 * @param  $location
	 * @param  $type
	 * @return json
	 */
	public function data($location, $type)
	{
		$data = $this->respondJSON($location);
		$places = $data['places']['place'];

		return $this->makeCollection($places, $type);
	}
}
