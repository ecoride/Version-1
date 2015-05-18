<?php namespace StartMeUp\Contracts\Repositories;

interface Repository {

	/**
	 * @return mixed
	 */
	public function get();

	/**
	 * @return mixed
	 */
	public function getCollection();

}
