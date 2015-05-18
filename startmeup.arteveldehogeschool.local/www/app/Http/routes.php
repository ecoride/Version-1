<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::controllers([
	'auth'     => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// Landing Page
// ============
Route::get('/', function() {
	return view('landing');
});

// Application Programming Interface Routes
// ========================================
Route::group(['prefix' => 'api'], function() {
	\Debugbar::disable();

	// API version 1
	// -------------
	Route::group(['prefix' => 'v1'], function() {
		Route::get('/', function() {
			return [
				'StartMeUp.io API' =>  [
					'version' => 1
				]
			];
		});
		Route::options('/', function() {
			return ['X-CSRF-TOKEN' => csrf_token()];
		});

		Route::resource('companies'       , 'Api\CompaniesController');
		Route::resource('locations'       , 'Api\LocationsController');
		Route::resource('users'           , 'Api\UsersController');
		Route::resource('users.categories', 'Api\UsersCategoriesController');
		Route::resource('users.goals'     , 'Api\UsersGoalsController');
		Route::get('/categories', function() {
			return [
				'categories' => StartMeUp\Models\Category::all(),
			];
		});
		Route::get('goals', function () {
			$goals = StartMeUp\Models\Goal::all();
			$goals->load('target');
			foreach ($goals as $goal) {
				if ($goal->target instanceof StartMeUp\Models\TargetIterableCheck ||
					$goal->target instanceof StartMeUp\Models\TargetTime) {
					$goal->target->load('updates');
				}
			}
			return [
				'goals' => $goals,
			];
		});
		Route::get('interests', function () {
			return [
				'interests' => StartMeUp\Models\Interest::all(),
			];
		});
		Route::get('targets', function () {
			$targetsCheck = StartMeUp\Models\TargetCheck::all();
			$targetsIterable = StartMeUp\Models\TargetIterableCheck::all();
			$targetsIterable->load('updates');
			$targetsTime = StartMeUp\Models\TargetTime::all();
			$targetsTime->load('updates');
			return [
				'targets' => array_merge($targetsCheck->toArray(), $targetsIterable->toArray(), $targetsTime->toArray()),
			];
		});
	});

});

// Back Office Routes
// ==================
Route::group(['prefix' => 'backoffice'], function() {
	Route::get('/', [
		'as'   => 'backoffice.home',
		'uses' => 'BackofficeController@index',
	]);
});

// Front Office Routes
// ===================
Route::group(['prefix' => 'frontoffice'], function() {
	Route::get('/', [
		'as'   => 'frontoffice.home',
		'uses' => 'FrontofficeController@index',
	]);
});

// Style Guide Routes
// ------------------
Route::get('/styleguide', [
	'as' => 'styleguide.home',
	function() {
		\Debugbar::disable();
		return view('styleguide');
	}
]);
