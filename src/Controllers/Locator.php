<?php

namespace Wishi\Controllers;

use Exception;
use Wishi\Model\State;
use Wishi\Model\County;
use Wishi\Model\Country;
use Wishi\Controllers\BaseController;
use Wishi\Exceptions\RequestException;

class Locator extends BaseController
{
	public function getCountries()
	{
		$places = $this->respondJSON($this->getter('countries'))['places']['place'];

		return $this->makeCollection($places, 'country');
	}

	public function getStates($countryName)
	{
		$data = $this->respondJSON( $this->getter('states/' . $countryName));
		$places = $data['places']['place'];

		return $this->makeCollection($places, 'state');
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

		return $this->makeCollection($places, 'county');
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
		try {
			return $this->client->request('GET', self::API_URL . $string . self::API_ATT . getenv('YAHOO_CLIENT_ID'));
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
		return json_decode( $res->getBody(), true );
	}
}
