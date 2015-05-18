;(function () { 'use strict';

	angular.module('smuControllers').
		controller('NearbyCtrl', [
			'$interpolate',
			'$log',
			'$scope',
			'LocationResourceFactory',
			'configMap',
			function ($interpolate, $log, $scope, LocationResourceFactory, configMap) {

				var templates = {
					location: '<b>{{ title }}</b><i><br>{{ subtitle }}</i><br>{{ address.street }} {{ address.street_number }}<br>{{ address.locality.postal_code }} {{ address.locality.name }}',
					you: '<b>You</b><br>You are here!'
				};
				var compileTemplateLocation = $interpolate(templates.location);

				var map = L.map('smu-map-0');
				L.tileLayer(configMap.tile.urlTemplate, configMap.tile.options).addTo(map);
				var iconCompany = L.icon(configMap.icon.company);

				LocationResourceFactory.query().
					$promise.then(
						// Success
						function (response) {
							response.data.forEach(function (resource) {
								var point = [resource.latitude, resource.longitude];
								var marker = L.marker(point, {icon: iconCompany}).addTo(map);
								marker.bindPopup(compileTemplateLocation(resource)).openPopup();
							});
						},
						// Error
						function (reason) {
							$log.error(reason);
						}
					);

				navigator.geolocation.getCurrentPosition(function (position) {
					var point = [position.coords.latitude, position.coords.longitude];
					map.setView(point, 12);
					var iconYou = L.icon(configMap.icon.you);
					var marker = L.marker(point, {icon: iconYou}).addTo(map);
					marker.bindPopup(templates.you).openPopup();
				});

			}
		]);

})();
