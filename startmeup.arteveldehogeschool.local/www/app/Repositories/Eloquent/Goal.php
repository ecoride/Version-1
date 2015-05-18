<?php namespace StartMeUp\Repositories\Eloquent;

use StartMeUp\Contracts\Repositories\Goal as GoalContract;
use StartMeUp\Models\Goal as GoalModel;

class Goal extends Repository implements GoalContract {

	protected $filtersValid = [
		\CreateUsersTable::TABLE,
	];

	protected $includesValid = [
		'target',
		'target.updates',
	];

	protected $sortsValid = [
		'order',
	];

	public function __construct(array $additionalInput = [])
	{
		$this->model = new GoalModel();
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
