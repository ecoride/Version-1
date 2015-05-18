<?php namespace StartMeUp\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use League\Fractal\Pagination\IlluminatePaginatorAdapter as FractalPaginatorAdapter;
use League\Fractal\Resource as FractalResource;
use StartMeUp\Http\Requests;
use StartMeUp\Http\Requests\StoreUserRequest;
use StartMeUp\Transformers\GenericTransformer;
use StartMeUp\User;

class UsersController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$limit = \Input::get('limit') ? (\Input::get('limit') > self::API_RESULT_LIMIT_MAX ? self::API_RESULT_LIMIT_MAX : \Input::get('limit')) : self::API_RESULT_LIMIT_DEFAULT;
		$order = \Input::get('order') === 'desc' ? 'desc': 'asc';

		// Eloquent
		$paginator = User::orderBy('id', $order)->paginate($limit);
		$paginator->appends('limit', $limit);
		$users = $paginator->getCollection();

		// Fractal
		$resource = new FractalResource\Collection($users, new GenericTransformer);
		$resource->setPaginator(new FractalPaginatorAdapter($paginator));

		return response()
			->json($this->getData($resource))
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
		// Validation through type hinting cannot be used here, because it is not a form post, but JSON data.
		$storeUserRequest = new StoreUserRequest();
		$rules = $storeUserRequest->rules();

		$data = json_decode($request->getContent(), true);

		$validator = \Validator::make($data['user'], $rules);
		if ($validator->fails()) {
			return response()
				->json([
					'errors' => $validator->errors()->all(),
				])
				->setStatusCode(Response::HTTP_BAD_REQUEST);
		}

		$data = json_decode($request->getContent(), true);
		$user = new User($data['user']);
		$user->password = \Hash::make($data['user']['password']);

		// @todo generic new resource response with id and link to resource.
//		$resource = new FractalResource\Item($user, new GenericTransformer);

		if ($user->save()) {
			return response()
				->json([
					'data' => [
						'id' => $user->id,
					]
				])
				->setStatusCode(Response::HTTP_CREATED);
		}

	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		$user = User::find($id);

		if (!$user) {
			return response()
				->json([
					'errors' => [
						['message' => "User with ID '${id}' does not exist."]
					]
				])
				->setStatusCode(Response::HTTP_NOT_FOUND);
		}

		$resource = new FractalResource\Item($user, new GenericTransformer);

		return response()
			->json($this->getData($resource));
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
