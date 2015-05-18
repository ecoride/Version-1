;(function () { 'use strict';

	angular.module('smuControllers').
		controller('LeaderboardCtrl', ['$scope', function ($scope) {

			$scope.leaderboard = [
				{
					position: 1,
					score: 910,
					user: {
						firstName: "Jane"
					},
					company: {
						name: "Arteveldehogeschool"
					}
				},{
					position: 2,
					score: 44,
					user: {
						firstName: "Olivier"
					},
					company: {
						name: "Superstar-up"
					}
				},{
					position: 3,
					score: 30,
					user: {
						firstName: "Christel"
					},
					company: {
						name: "Arteveldehogeschool"
					}
				}
			];

		}]);

})();
