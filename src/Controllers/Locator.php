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
}
