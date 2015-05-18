<?php
// "tests/helpers" must be added to `composer.json` and then run `$ composer dump-autoload` so it wil be autoloaded!

abstract class ApiTestCase extends TestCase {

	/**
	 * URI of the API.
	 *
	 * @var string
	 */
	protected $uri = 'api/v1/';

	/**
	 *
	 */
	protected function callGET($path)
	{
		return $this->call('GET', $this->uri . $path);
	}

	/**
	 *
	 */
	protected function callPOST($path, $data)
	{
		return $this->call('POST', $this->uri . $path);
	}

}
