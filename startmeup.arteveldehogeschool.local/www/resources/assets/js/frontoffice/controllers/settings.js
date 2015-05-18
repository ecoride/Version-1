;(function () { 'use strict';

	angular.module('smuControllers').
		controller('SettingsCtrl', ['$scope', function ($scope) {

			$scope.menu = [
				{
					label: "User account",
					uri: "#/settings/user-account"
				}, {
					label: "Personal profile",
					uri: "#/settings"
				}, {
					label: "Company profile",
					uri: "#/settings/"
				}, {
					label: "Privacy",
					uri: "#/settings"
				}
			];

		}]);

})();
