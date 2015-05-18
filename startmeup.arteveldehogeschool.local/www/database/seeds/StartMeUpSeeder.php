<?php

use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

abstract class StartMeUpSeeder extends Seeder {

	/**
	 * @var Faker
	 */
	protected $faker = null;

	/**
	 * @var string
	 */
	protected $fakerLocale = 'nl_BE';

	/**
	 * @var int
	 */
	protected $fakerMaxItems = 10;

	public function __construct() {
		$this->faker = Faker::create($this->fakerLocale);
	}

}
