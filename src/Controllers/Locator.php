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
		return $this->data($this->getter('countries'), 'country');
	}

	public function getStates($countryName)
	{
		return $this->data($this->getter('states/' . $countryName), 'state');
	}

	/**
	 * This method gets all counties under a state.
	 *
	 * @param $stateName
	 * @return collection
	 */
	public function getCounties($stateName)
	{
		return $this->data($this->getter('counties/'.$stateName), 'county');
	}
}
