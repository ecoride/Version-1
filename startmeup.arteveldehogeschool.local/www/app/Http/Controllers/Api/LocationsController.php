<?php namespace StartMeUp\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter as FractalPaginatorAdapter;
use League\Fractal\Resource as FractalResource;
use StartMeUp\Location;
use StartMeUp\Transformers\GenericTransformer;

class LocationsController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = \Input::get('limit') ? (\Input::get('limit') > self::API_RESULT_LIMIT_MAX ? self::API_RESULT_LIMIT_MAX : \Input::get('limit')) : self::API_RESULT_LIMIT_DEFAULT;

		// Eloquent
		$paginator = Location::paginate($limit);
		$paginator->appends('limit', $limit);
		$locations = $paginator->getCollection();

		// Fractal
		$resource = new FractalResource\Collection($locations, new GenericTransformer);
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
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//Eloquent
		$location = Location::find($id);

		if (!$location) {
			return response()
				->json([
					'errors' => [
						['message' => "Location with ID '${id}' does not exist."]
					]
				])
				->setStatusCode(Response::HTTP_NOT_FOUND);
		}

		// Fractal
		$resource = new FractalResource\Item($location, new GenericTransformer);
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
