;(function () { 'use strict';

	angular.module('smuFactories').
		factory('apiUriFactory', ['$location', 'configApi', function ($location, configApi) {

			return {
				make: function (path) {
					var protocol = configApi.protocol ? configApi.protocol : $location.protocol();
					var host     = configApi.host     ? configApi.host     : $location.host();
					var uri = protocol + '://' + host + configApi.path + path;

					return uri;
				}
			}

		}]);

})();
