<?php namespace StartMeUp\Repositories\Eloquent;

use StartMeUp\Contracts\Repositories\Category as CategoryContract;
use StartMeUp\Models\Category as CategoryModel;

class Category extends Repository implements CategoryContract {

	protected $filtersValid = [
		\CreateUsersTable::TABLE,
	];

	protected $includesValid = [
		'goals',
		'goals.target',
		'goals.target.updates',
	];

	protected $sortsValid = [
		'order',
	];

	public function __construct(array $additionalInput = [])
	{
		$this->model = new CategoryModel();
		$this->query = $this->model->query();
		parent::__construct($additionalInput);
	}

	public function applyFilters()
	{
		foreach ($this->filters as $filter => $value) {
			switch ($filter) {
				case \CreateUsersTable::TABLE:
					$this->model = $this->model->where(\CreateUsersTable::FK, $value);
					break;
				default:
					break;
			}
		}
	}


}
