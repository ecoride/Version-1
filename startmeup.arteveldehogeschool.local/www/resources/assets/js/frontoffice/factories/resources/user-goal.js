;(function () { 'use strict';

	angular.module('smuFactories').
		factory('UserGoalResourceFactory', ['$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('users/:userId/goals/:goalId'),
				{
					userId: '@id',
					goalId: '@id'
				},
				{
					'getWithGoals':   { method: 'GET', params: { 'include[target]': true } },
					'queryWithGoals': { method: 'GET', params: { 'include[target]': true, 'sort[order]': '@order' }, isArray: false }
				}
			);

		}]);

})();
