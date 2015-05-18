<?php

use Illuminate\Http\Response;

class ApiCompaniesControllerTest extends ApiTestCase {

	/**
	 * @test
	 * @covers Api\CompaniesController::index()
	 */
	public function it_should_fetch_all_companies()
	{
		// Arrange

		// Act
		$response = $this->callGET('companies');
		$companies = json_decode($response->getContent());

		// Assert
		$this->assertResponseOk();
		$this->assertGreaterThan(0, count($companies));
	}


	/**
	 * @test
	 * @covers Api\CompaniesController::show()
	 */
	public function it_should_fetch_a_single_company()
	{
		// Arrange

		// Act
		$response = $this->callGET('companies/1');
		$user = json_decode($response->getContent());

		// Assert
		$this->assertResponseOk();
		$this->assertInternalType('object', $user);
	}

	/**
	 * @test
	 * @covers Api\CompaniesController::show()
	 */
	public function it_should_return_HTTP_NOT_FOUND_when_trying_to_fetch_non_existing_company()
	{
		// Arrange

		// Act
		$response = $this->callGET('companies/9999999');
		$company = json_decode($response->getContent());

		// Assert
		$this->assertResponseStatus(Response::HTTP_NOT_FOUND);
		$this->assertInternalType('object', $company);
	}

	/**
	 * @test
	 * @covers Api\CompaniesController::store()
	 */
	public function it_should_create_a_new_company()
	{
		\Session::start();
		// Arrange
		$parameters = [
			'_token' => csrf_token(),
		];
		$content = [
			'company' => [
//				'email'       => 'smu_user_'. mt_rand() .'@arteveldehs.be',
//				'name'        => 'smu_user',
//				'password'    => 'smu_password',
//				'given_name'  => 'Start',
//				'family_name' => 'Me Up',
			],
		];

		// Act
		$response = $this->call('POST', '/api/v1/companies', $parameters, $cookies = [], $files = [], $server = [], json_encode($content));

		// Assert
		$this->assertResponseStatus(Response::HTTP_CREATED);
		$content = json_decode($response->getContent());
		$this->assertObjectHasAttribute('data', $content);
		$this->assertObjectHasAttribute('id'  , $content->data);
	}

}
