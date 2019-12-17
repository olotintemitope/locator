<?php

namespace Wishi\Controllers;

use Wishi\Model\Country;
use Wishi\Model\County;
use Wishi\Model\State;

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
        return $this->data($this->getter('countries'), 'country');
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
        return $this->data($this->getter('states/'.$countryName), 'state');
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
        return $this->data($this->getter('counties/'.$stateName), 'county');
    }
}
