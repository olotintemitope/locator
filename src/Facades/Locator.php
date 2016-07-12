<?php

namespace Wishi\Facades;

use Illuminate\Support\Facades\Facade;

/**
*
*/
class Locator extends Facades
{
	/**
	 * Get the registered name of the component.
	 * 
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'locator';
	}
}