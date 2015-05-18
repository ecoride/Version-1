<?php namespace StartMeUp\Repositories\Eloquent;

abstract class Repository {

	const LIMIT_DEFAULT = 100;
	const LIMIT_MAX     = 1000;

	const ORDER_ASCENDING  = 'ASC';
	const ORDER_DESCENDING = 'DESC';

	/**
	 * @var array
	 */
	protected $input = [];

	/**
	 * @var null
	 */
	protected $model = null;

	/**
	 * @var null
	 */
	protected $query = null;

	/**
	 * @var null
	 */
	protected $paginator = null;

	/**
	 * @var int
	 */
	protected $limit = self::LIMIT_DEFAULT;

	/**
	 * @var array
	 */
	protected $filters = [];

	/**
	 * @var array
	 */
	protected $filtersValid = [];

	/**
	 * @var array
	 */
	protected $includes = [];

	/**
	 * @var array
	 */
	protected $includesValid = [];

	/**
	 * @var array
	 */
	protected $sorts = [];

	/**
	 * @var array
	 */
	protected $sortsValid = [];

	public function __construct(array $additionalInput = [])
	{
		$input = \Input::only('include', 'filter', 'limit', 'sort');
		$this->input = array_merge($input, $additionalInput);

		// Filter result set
		if (isset($this->input['filter'])) {
			$this->addFilters($this->input['filter']);
		}
		$this->applyFilters();

		// Order filtered result set
		if (isset($this->input['sort'])) {
			$this->addSorts($this->input['sort']);
		}
		$this->applySorts();

		// Limit and paginate filtered result set
		if (isset($this->input['limit'])) {
			$this->setLimit($this->input['limit']);
		}
		$this->applyLimit();

		// Load included models
		if (isset($this->input['include'])) {
			$this->addIncludes($this->input['include']);
		}
		$this->applyIncludes(true);
	}

	/**
	 * @param $filter
	 * @param $value
	 * @return $this
	 * @throws \Exception
	 */
	public function addFilter($filter, $value)
	{
		if (in_array($filter, $this->filtersValid)) {
			$this->filters[$filter] = $value;
		} else {
			throw new \Exception("Invalid filter: `${filter}`");
		}

		return $this;
	}

	/**
	 * @param array $filters
	 * @return $this
	 * @throws \Exception
	 */
	public function addFilters(array $filters)
	{
		foreach ($filters as $filter => $value) {
			$this->addFilter($filter, $value);
		}

		return $this;
	}

	abstract public function applyFilters();

	/**
	 * @param $include
	 * @return $this
	 * @throws \Exception
	 */
	public function addInclude($include)
	{
		if (in_array($include, $this->includesValid)) {
			array_push($this->includes, $include);
		} else {
			throw new \Exception("Invalid include: `${include}`");
		}

		return $this;
	}

	/**
	 * @param array $includes
	 * @return $this
	 * @throws \Exception
	 */
	public function addIncludes(array $includes)
	{
		foreach ($includes as $include => $value) {
			$this->addInclude($include);
		}

		return $this;
	}

	/**
	 * @param bool $usePaginator
	 */
	public function applyIncludes($usePaginator = false)
	{
		$models = ($usePaginator) ? $this->paginator : $this->model;
		foreach ($this->includes as $include) {
			$models->load($include);
		}
	}

	/**
	 * @param $column
	 * @param string $direction
	 * @return $this
	 * @throws \Exception
	 */
	public function addSort($column, $direction = self::ORDER_ASCENDING)
	{
		if (in_array($column, $this->sortsValid)) {
			$this->sorts[$column] = (strtoupper($direction) === self::ORDER_DESCENDING) ? self::ORDER_DESCENDING : self::ORDER_ASCENDING;
		} else {
			throw new \Exception("Invalid sort column: `${column}`");
		}

		return $this;
	}

	/**
	 * @param array $sorts
	 * @return $this
	 * @throws \Exception
	 */
	public function addSorts(array $sorts)
	{
		foreach ($sorts as $column => $direction) {
			$this->addSort($column, $direction);
		}

		return $this;
	}

	/**
	 *
	 */
	public function applySorts()
	{
		foreach ($this->sorts as $column => $direction) {
			$this->model = $this->model->orderBy($column, $direction);
		}
	}

	/**
	 * @param $limit
	 * @return $this
	 */
	public function setlimit($limit)
	{
		$this->limit = ($limit < self::LIMIT_MAX) ? $limit : self::LIMIT_MAX;;

		return $this;
	}

	/**
	 *
	 */
	public function applyLimit()
	{
		$this->paginator = $this->model->paginate($this->limit);
		$this->paginator->appends('limit', $this->limit); // @link http://laravel.com/docs/5.0/pagination#appending-to-pagination-links
	}

	/**
	 * @param $id
	 * @return mixed
	 */
	public function find($id)
	{
		$this->model = $this->model->find($id);
		$this->applyIncludes();
		return $this->model;
	}

	/**
	 * @return mixed
	 */
	public function get()
	{
		return $this->model->get();
	}

	/**
	 * @return mixed
	 */
	public function getCollection()
	{
		return $this->paginator->getCollection();
	}

	/**
	 * @return null
	 */
	public function getPaginator()
	{
		return $this->paginator;
	}

}
