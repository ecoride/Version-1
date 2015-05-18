;(function () { 'use strict';

	angular.module('smuControllers').
		controller('RegistrationCtrl', [
			'$log',
			'$route',
			'$rootScope',
			'$scope',
			'RegistrationFormStateFactory',
			'UserResourceFactory',
			function ($log, $route, $rootScope, $scope, RegistrationFormStateFactory, UserResourceFactory) {

				var formState = RegistrationFormStateFactory;
				angular.extend($scope, formState);

				$log.info('step: ', $route.current.step);
				switch ($route.current.step) {
					case 1:
						// User Account
						$scope.clickHandler = function () {
							$log.info('user: ', $scope.user);
							angular.extend(formState.user, $scope.user);
						};
						break;
					case 2:
						// Personal Profile
						$scope.clickHandler = function () {
							$log.info('user: ', $scope.user);
							angular.extend(formState.user, $scope.user);
						};
						break;
					case 3:
						// Company Profile
						$scope.clickHandler = function () {
							$log.info('user: '   , $scope.user);
							$log.info('company: ', $scope.company);
							$log.info('address: ', $scope.address);
							var userResource = new UserResourceFactory();
							userResource.user = formState.user;
							userResource.$save();
						};
						break;
					default:
						break;
				}

			}
		]);

})();
