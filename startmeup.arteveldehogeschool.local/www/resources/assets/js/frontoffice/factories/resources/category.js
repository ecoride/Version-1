;(function () { 'use strict';

	angular.module('smuFactories').
		factory('CategoryResourceFactory', ['$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('categories/:categoryId'),
				{
					categoryId: '@categoryId'
				},
				{
					'queryWithGoals': { method: 'GET', params: { 'include[goals]': true, 'sort[order]': '@order' }, isArray: false }
				}
			);

		}]);

})();
