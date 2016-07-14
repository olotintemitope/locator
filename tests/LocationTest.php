<?php

use Mockery as M;

class TestCase extends PHPUnit_Framework_TestCase
{
	private $placeOne = [ 'woeid' => 120, 'name' => 'Nigeria', 'uri' => 'http://url_for_nigeria'];
	
	private $placeTwo = [ 'woeid' => 121, 'name' => 'Ghana', 'uri' => 'http://url_for_ghana'];

	protected $data;
	
	protected $locator;

	protected $client;

	protected $dotenv;

	public function setUp()
	{
		$this->client = M::mock('GuzzleHttp\Client');
		$this->dotenv = M::mock('Dotenv\Dotenv');
		$this->dotenv->shouldReceive('load');

		$this->locator = new Wishi\Controllers\Locator($this->client, $this->dotenv);

		$this->data = json_encode([
			'places' => [
				'place' => [$this->placeOne, $this->placeTwo]
			]
		]);
	}

	public function testGetCountries()
	{
		$this->prepareMock();

		$countries = $this->locator->getCountries();

		$this->performAssertions($countries, 'Country');
	}

	public function testGetStates()
	{
		$this->prepareMock();

		$states = $this->locator->getStates('Country');

		$this->performAssertions($states, 'State');
	}

	public function testGetCounties()
	{
		$this->prepareMock();

		$counties = $this->locator->getCounties('State');

		$this->performAssertions($counties, 'County');
	}

	/**
	 * @expectedException Wishi\Exceptions\RequestException
	 * @expectedExceptionMessage  Wishi Exception: Oops something went wrong, please try again!
	 * 
	 * @return [type] [description]
	 */
	public function testExceptions()
	{
		$res = M::mock('GuzzleHttp\Psr7\Response');
		$this->client->shouldReceive('request')->andThrow('Wishi\Exceptions\RequestException');

		$states = $this->locator->getStates('CountryWithNoStates');
	}

	private function prepareMock()
	{
		$res = M::mock('GuzzleHttp\Psr7\Response');
		$this->client->shouldReceive('request')->andReturn($res);
		$res->shouldReceive('getBody')->andReturn($this->data);
	}

	private function performAssertions($locations, $class)
	{
		$this->assertInstanceOf('Illuminate\Support\Collection', $locations);

		foreach ($locations as $location) {
			$this->assertInstanceOf('Wishi\Model' . "\\$class", $location);
		}
	}
}