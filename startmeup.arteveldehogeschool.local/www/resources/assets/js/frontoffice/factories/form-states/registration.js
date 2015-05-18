;(function () { 'use strict';

	angular.module('smuFactories').
		factory('RegistrationFormStateFactory', ['$resource', 'configApi', function ($resource, configApi) {

			return {
				address: {},
				company: {},
				settings: {},
				user: {}
			};

		}]);

})();
