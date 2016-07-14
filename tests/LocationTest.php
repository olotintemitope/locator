<?php

use Mockery as M;

class TestCase extends PHPUnit_Framework_TestCase
{
	private $placeOne = [ 'woeid' => 120, 'name' => 'Nigeria', 'uri' => 'http://url_for_nigeria'];
	
	private $placeTwo = [ 'woeid' => 121, 'name' => 'Ghana', 'uri' => 'http://url_for_ghana'];
	
	protected $locator;

	protected $client;

	protected $dotenv;

	public function setUp()
	{
		$this->client = M::mock('GuzzleHttp\Client');
		$this->dotenv = M::mock('Dotenv\Dotenv');
		$this->dotenv->shouldReceive('load');

		$this->locator = new Wishi\Controllers\Locator($this->client, $this->dotenv);
	}

	public function testGetCountries()
	{
		$data = json_encode([
			'places' => [
				'place' => [$this->placeOne, $this->placeTwo]
			]
		]);

		$res = M::mock('GuzzleHttp\Psr7\Response');

		$this->client->shouldReceive('request')->andReturn($res);
		$res->shouldReceive('getBody')->andReturn($data);

		$countries = $this->locator->getCountries();

		$this->assertInstanceOf('Illuminate\Support\Collection', $countries);

		foreach ($countries as $country) {
			$this->assertInstanceOf('Wishi\Model\Country', $country);
		}
	}
}