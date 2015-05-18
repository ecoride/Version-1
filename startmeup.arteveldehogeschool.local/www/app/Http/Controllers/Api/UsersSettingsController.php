<?php namespace StartMeUp\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter as FractalPaginatorAdapter;
use League\Fractal\Resource as FractalResource;
use StartMeUp\Http\Requests;
use StartMeUp\Models\Category;
use StartMeUp\Transformers\GenericTransformer;

class UsersSettingsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($userId)
	{
		$userId = (int) $userId; // @todo Implement user

		$include = \Input::get('include');
		$limit   = \Input::get('limit') ? (\Input::get('limit') > self::API_RESULT_LIMIT_MAX ? self::API_RESULT_LIMIT_MAX : \Input::get('limit')) : self::API_RESULT_LIMIT_DEFAULT;
		$order   = \Input::get('order') === 'desc' ? 'desc': 'asc';

		// Eloquent
		$paginator = Category::where('user_id', $userId)->orderBy('order', $order)->paginate($limit);
		switch ($include) {
			case 'goals':
				$paginator->load('goals');
				break;
			default:
				break;
		}
		$paginator->appends('limit', $limit);
		$categories = $paginator->getCollection();

		// Fractal
		$resource = new FractalResource\Collection($categories, new GenericTransformer);
		$resource->setPaginator(new FractalPaginatorAdapter($paginator));
		$data = $this->fractal->createData($resource)->toArray();

		return response()
			->json($data)
			->setStatusCode(Response::HTTP_OK);
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store(Request $request)
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param $userId
	 * @param $categoryId
	 * @return Response
	 */
	public function show($userId, $categoryId)
	{
		$userId     = (int) $userId;
		$categoryId = (int) $categoryId;

		// Eloquent
		$include = \Input::get('include');
		switch ($include) {
			case 'goals':
				$category = Category::where('user_id', $userId)->with('goals')->find($categoryId);
				break;
			default:
				$category = Category::where('user_id', $userId)->find($categoryId);
				break;
		}

		// Fractal
		$resource = new FractalResource\Item($category, new GenericTransformer);
		$data = $this->fractal->createData($resource)->toArray();

		return response()
			->json($data)
			->setStatusCode(Response::HTTP_OK);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
