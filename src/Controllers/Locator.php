<?php

namespace Wishi\Controllers;

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
        $data = $this->toJson($this->getter('countries'));
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
        $data = $this->toJson($this->getter('states/' . $countryName));
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
        $data = $this->toJson($this->getter('counties/' . $stateName));
        $places = $data['places']['place'];

        return $this->makeCollection($places, 'county');
    }
}
