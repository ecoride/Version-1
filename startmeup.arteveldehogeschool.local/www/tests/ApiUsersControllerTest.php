<?php

use Illuminate\Http\Response;

class ApiUsersControllerTest extends ApiTestCase {

	/**
	 * @test
	 * @covers Api\UserController::index()
	 */
	public function it_should_fetch_all_users()
	{
		// Arrange

		// Act
		$response = $this->callGET('users');
		$users = json_decode($response->getContent());

		// Assert
		$this->assertResponseOk();
		$this->assertGreaterThan(0, count($users));
	}

	/**
	 * @test
	 * @covers Api\UserController::show()
	 */
	public function it_should_fetch_a_single_user()
	{
		// Arrange

		// Act
		$response = $this->callGET('users/1');
		$user = json_decode($response->getContent());

		// Assert
		$this->assertResponseOk();
		$this->assertInternalType('object', $user);
	}

	/**
	 * @test
	 * @covers Api\UserController::show()
	 */
	public function it_should_return_HTTP_NOT_FOUND_when_trying_to_fetch_non_existing_user()
	{
		// Arrange

		// Act
		$response = $this->callGET('users/9999999');
		$user = json_decode($response->getContent());

		// Assert
		$this->assertResponseStatus(Response::HTTP_NOT_FOUND);
		$this->assertInternalType('object', $user);
	}

	/**
	 * @test
	 * @covers Api\UserController::store()
	 */
	public function it_should_create_a_new_user()
	{
		\Session::start();
		// Arrange
		$parameters = [
			'_token' => csrf_token(),
		];
		$content = [
			'user' => [
				'email'       => 'smu_user_'. mt_rand() .'@arteveldehs.be',
				'name'        => 'smu_user',
				'password'    => 'smu_password',
				'given_name'  => 'Start',
				'family_name' => 'Me Up',
			],
		];

		// Act
		$response = $this->call('POST', '/api/v1/users', $parameters, $cookies = [], $files = [], $server = [], json_encode($content));

		// Assert
		$this->assertResponseStatus(Response::HTTP_CREATED);
		$content = json_decode($response->getContent());
		$this->assertObjectHasAttribute('data', $content);
		$this->assertObjectHasAttribute('id'  , $content->data);
	}

}
