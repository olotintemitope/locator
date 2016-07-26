<?php

namespace Wishi\Controllers;

use Wishi\Model\State;
use Wishi\Model\County;
use Wishi\Model\Country;

class Locator extends BaseController
{
    /**
     * This method gets all the countries.
     *
     * @param void
     *
     * @return collection
     */
    public function getCountries()
    {
        $data = $this->respondJSON($this->getter('countries'));
        $places = $data['places']['place'];
        return $this->makeCollection($places, 'country');
    }
    /**
     * This method get all the states under a valid country name.
     *
     * @param $countryName
     *
     * @return collection
     */
    public function getStates($countryName)
    {
        $data = $this->respondJSON($this->getter('states/'.$countryName));
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
