<?php namespace StartMeUp\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter as FractalPaginatorAdapter;
use League\Fractal\Resource as FractalResource;
use StartMeUp\Http\Requests;
use StartMeUp\Repositories\Eloquent\Category as CategoryRepository;
use StartMeUp\Transformers\GenericTransformer;

class UsersCategoriesController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index($userId)
	{
		/*
		 * filter[attribute]
		 * limit=100
		 * sort[attribute]=desc
		 * include[table_name]
		 */

		// Laravel Eloquent
		$additionalInput = [
			'filter' => [
				'users' => (int) $userId,
			]
		];
		$categoryRepository = new CategoryRepository($additionalInput);

		$categories = $categoryRepository->getCollection();
		$paginator  = $categoryRepository->getPaginator();

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
		/*
		 * filter[attribute]
		 * include[table_name]
		 */

		// Laravel Eloquent
		$additionalInput = [
			'filter' => [
				'users' => (int) $userId,
			]
		];
		$categoryRepository = new CategoryRepository($additionalInput);
		$category = $categoryRepository->find((int) $categoryId);

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
