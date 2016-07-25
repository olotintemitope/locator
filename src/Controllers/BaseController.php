<?php

namespace Wishi\Controllers;

use Dotenv\Dotenv;
use GuzzleHttp\Client as GuzzleClient;

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
	public function __construct(GuzzleClient $client = null, Dotenv $dotenv = null)
	{
		$this->client = $client == null ? new GuzzleClient() : $client;

		$dotenv = $dotenv == null ? new Dotenv(APP_ROOT) : $dotenv;

		$dotenv->load();
	}
}
