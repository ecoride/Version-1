;(function () { 'use strict';

	angular.module('smuFactories').
		factory('UserCategoryResourceFactory', ['$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('users/:userId/categories/:categoryId'),
				{
					userId: '@id',
					categoryId: '@id'
				},
				{
					'getWithGoals':   { method: 'GET', params: { 'include[goals]': true } },
					'queryWithGoals': { method: 'GET', params: { 'include[goals.target.updates]': true, 'sort[order]': '@order' }, isArray: false }
				}
			);

		}]);

})();
