;(function () { 'use strict';

	angular.module('smuControllers').
		controller('GoalsCtrl', [
			'$filter',
			'$location',
			'$log',
			'$rootScope',
			'$routeParams',
			'$scope',
			'targetClasses',
			'UserCategoryResourceFactory',
			function ($filter, $location, $log, $rootScope, $routeParams, $scope, targetClasses, UserCategoryResourceFactory) {

				$log.info($routeParams);
				$scope.categoryId = $routeParams.categoryId;
				$scope.goalId     = $routeParams.goalId;

				var now = new Date();

				$scope.now = {
					date: now.getFullYear() + '-' + now.getMonth()   + '-' + now.getDate(),
					time: now.getHours()    + ':' + now.getMinutes()
				};

				$scope.categories = [];

				UserCategoryResourceFactory.queryWithGoals({ userId: 1, 'sort[order]': 'asc' }).
					$promise.then(
						// Success
						function (response) {
							$log.info($scope.categories);
							$scope.categories = response.data;

							if (typeof $scope.categoryId != 'undefined' && typeof $scope.goalId != 'undefined') {
								var goals = _.result(
									_.find($scope.categories, function(category) {
										return category.id == $scope.categoryId;
									}),
									'goals'
								);

								$log.info(goals);

								$scope.goal = _.find(goals, function (goal) {
									return goal.id == $scope.goalId;
								});
								$log.info($scope.goal);
							}

						},
						// Error
						function (reason) {
							$log.error(reason);
						}
					);



			}
		]);
})();
