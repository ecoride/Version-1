;(function () { 'use strict';

	// StartMeUp.io application
	// ------------------------

	var application = angular.module('smuApplication', [
		// Angular module dependencies
		'ngMaterial',
		'ngMessages',
		'ngResource',
		'ngRoute',

		// StartMeUp.io module dependencies
		'smuControllers',
		'smuDirectives',
		'smuFactories',
		'smuFilters',
		'smuServices'
	]);

	// StartMeUp.io module declarations
	// -----------------------------

	angular.module('smuControllers', []);
	angular.module('smuDirectives' , []);
	angular.module('smuFactories'  , []);
	angular.module('smuFilters'    , []);
	angular.module('smuServices'   , []);

	// Application configuration
	// -------------------------

	application.
		constant('targetClasses', {
			check        : 'TargetCheck',
			iterableCheck: 'TargetIterableCheck',
			time         : 'TargetTime'
		}).
		constant('configApi', {
			protocol: null,
			host    : null,
			path    : '/api/v1/'
		}).
		constant('configChart', {
			bar: {
				//Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
				scaleBeginAtZero : true,

				//Boolean - Whether grid lines are shown across the chart
				scaleShowGridLines : true,

				//String - Colour of the grid lines
				scaleGridLineColor : "rgba(0,0,0,.05)",

				//Number - Width of the grid lines
				scaleGridLineWidth : 1,

				//Boolean - Whether to show horizontal lines (except X axis)
				scaleShowHorizontalLines: true,

				//Boolean - Whether to show vertical lines (except Y axis)
				scaleShowVerticalLines: true,

				//Boolean - If there is a stroke on each bar
				barShowStroke : true,

				//Number - Pixel width of the bar stroke
				barStrokeWidth : 2,

				//Number - Spacing between each of the X value sets
				barValueSpacing : 5,

				//Number - Spacing between data sets within X values
				barDatasetSpacing : 1,

				//String - A legend template
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"
			},
			line: {

				//Boolean - Whether grid lines are shown across the chart
				scaleShowGridLines : true,

				//String - Colour of the grid lines
				scaleGridLineColor : "rgba(0,0,0,.05)",

				//Number - Width of the grid lines
				scaleGridLineWidth : 1,

				//Boolean - Whether to show horizontal lines (except X axis)
				scaleShowHorizontalLines: true,

				//Boolean - Whether to show vertical lines (except Y axis)
				scaleShowVerticalLines: true,

				//Boolean - Whether the line is curved between points
				bezierCurve : true,

				//Number - Tension of the bezier curve between points
				bezierCurveTension : 0.4,

				//Boolean - Whether to show a dot for each point
				pointDot : true,

				//Number - Radius of each point dot in pixels
				pointDotRadius : 4,

				//Number - Pixel width of point dot stroke
				pointDotStrokeWidth : 1,

				//Number - amount extra to add to the radius to cater for hit detection outside the drawn point
				pointHitDetectionRadius : 20,

				//Boolean - Whether to show a stroke for datasets
				datasetStroke : true,

				//Number - Pixel width of dataset stroke
				datasetStrokeWidth : 2,

				//Boolean - Whether to fill the dataset with a colour
				datasetFill : true,

				//String - A legend template
				legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].lineColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

			}
		}).
		constant('configMap', {
			tile: {
				urlTemplate: 'http://{s}.tile.osm.org/{z}/{x}/{y}.png',
				options: {
					attribution: '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors'
				}
			},
			icon: {
				company: {
					iconUrl:   '/images/nearby/icon.svg',
					shadowUrl: '/images/nearby/icon-shadow.svg',

					iconSize:     [50, 50], // size of the icon
					shadowSize:   [50, 50], // size of the shadow
					iconAnchor:   [50, 50], // point of the icon which will correspond to marker's location
					shadowAnchor: [ 5,  5], // the same for the shadow
					popupAnchor:  [ 0,  0]  // point from which the popup should open relative to the iconAnchor
				},
				you: {
					iconUrl:   '/images/nearby/icon.svg',
					shadowUrl: '/images/nearby/icon-shadow.svg',

					iconSize:     [50, 50], // size of the icon
					shadowSize:   [50, 50], // size of the shadow
					iconAnchor:   [50, 50], // point of the icon which will correspond to marker's location
					shadowAnchor: [ 5,  5], // the same for the shadow
					popupAnchor:  [ 0,  0]  // point from which the popup should open relative to the iconAnchor
				}
			}
		}).
		config([
			'$compileProvider',
			'$mdThemingProvider',
			'$resourceProvider',
			function ($compileProvider, $mdThemingProvider, $resourceProvider) {

				$compileProvider.debugInfoEnabled(true); // Set to `false` for production

				$resourceProvider.defaults.actions.query.isArray = false; // Allow { 'data': [ … ] } rather than [ … ]
				//console.info($resourceProvider.defaults.actions);

				$mdThemingProvider.theme('default').
					primaryPalette('brown', {
						'default':  '50',
						'hue-1':    '50',
						'hue-2':   '600',
						'hue-3':  'A100'
					}).
					accentPalette('red', {
						'default': '900',
						'hue-1':    '50',
						'hue-2':   '600',
						'hue-3':  'A100'
					}).
					warnPalette('pink');

			}
		]);

})();

;(function () { 'use strict';

	function getView(uri) {
		return '/templates/views/' + uri + '.html';
	}

	function getPartialView(uri) {
		return '/templates/partials/' + uri + '.html';
	}

	angular.module('smuApplication').
		config(['$routeProvider', function ($routeProvider) {
			$routeProvider.
				when('/gamification', {
					templateUrl: getView("gamification/shoot")
				}).
				when('/gamification/leaderboard', {
					templateUrl: getView("gamification/leaderboard")
				}).
				when('/gamification/trophies', {
					templateUrl: getView("gamification/trophies")
				}).
				when('/goals', {
					templateUrl: getView("goals/overview")
				}).
				when('/goals/category/:categoryId/edit', {
					templateUrl: getView("goals/category/edit")
				}).
				when('/goals/category/:categoryId/goal/add', {
					templateUrl: getView("goals/goal/add"),
					controller: "GoalsCtrl"
				}).
				when('/goals/category/:categoryId/goal/:goalId/edit', {
					templateUrl: getView("goals/goal/edit"),
					controller: "GoalsCtrl"
				}).
				when('/goals/category/:categoryId/goal/:goalId/update', {
					templateUrl: getView("goals/goal/update"),
					controller: "GoalsCtrl"
				}).
				when('/goals/statistics', {
					templateUrl: getView("goals/statistics"),
					controller: "GoalsStatisticsCtrl"
				}).
				when('/goals/category/:categoryId/goal/:goalId/statistics', {
					templateUrl: getView("goals/goal/statistics"),
					controller: "GoalsStatisticsCtrl"
				}).
				when('/goals/category/add', {
					templateUrl: getView("goals/category/add")
				}).
				when('/goals/statistics', {
					templateUrl: getView("goals/statistics"),
					controller: "GoalsStatisticsGlobalCtrl"
				}).
				when('/nearby', {
					templateUrl: getView("nearby/map")
				}).
				when('/registration/step/1/of/4', {
					templateUrl: getView("registration/1-user-account"),
					controller: "RegistrationCtrl",
					step: 1,
					steps: 4
				}).
				when('/registration/step/2/of/4', {
					templateUrl: getView("registration/2-personal-profile"),
					controller: "RegistrationCtrl",
					step: 2,
					steps: 4
				}).
				when('/registration/step/3/of/4', {
					templateUrl: getView("registration/3-company-profile"),
					controller: "RegistrationCtrl",
					step: 3,
					steps: 4
				}).
				when('/registration/step/4/of/4', {
					templateUrl: getView("registration/4-completed"),
					controller: "RegistrationCtrl",
					step: 4,
					steps: 4
				}).
				when('/settings', {
					templateUrl: getView("settings/menu")
				}).
				when('/log-in', {
					templateUrl: getView("log-in")
				}).
				when('/splash', {
					templateUrl: getView("splash")
					//controller: "StartCtrl"
				}).
				otherwise({
					redirectTo: '/splash'
				});
		}]).
		// Preload templates
		// -----------------
		run([
			'$http',
			'$templateCache',
			function ($http, $templateCache) {
				var partials = [
					'validation-messages'
				];

				var views = [
					'registration/1-user-account',
					'registration/2-personal-profile',
					'registration/3-company-profile',
					'registration/4-completed'
				];

				partials.forEach(function (template) {
					$http.get(getPartialView(template), { cache: $templateCache });
				});

				views.forEach(function (template) {
					$http.get(getView(template), { cache: $templateCache });
				});

			}
		]);

})();

;(function () { 'use strict';

	angular.module('smuControllers').
		controller('GoalsStatisticsCtrl', ['$routeParams', '$scope', 'configChart', function ($routeParams, $scope, configChart) {

			$scope.categoryId = $routeParams.categoryId;
			$scope.goalId     = $routeParams.goalId;

			var ctx = document.getElementById("smu-chart-0").getContext("2d");

			var data = {
				labels: ["January", "February", "March", "April", "May", "June", "July"],
				datasets: [
					{
						label: "My First dataset",
						fillColor: "rgba(220,220,220,0.5)",
						strokeColor: "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data: [12, 10, 11, 9, 5, 3, 2]
					}
				]
			};

			var smuChart0 = new Chart(ctx).Bar(data, configChart.bar);

		}]);
})();

;(function () { 'use strict';

	angular.module('smuControllers').
		controller('GoalsStatisticsCtrl', ['$routeParams', '$scope', 'configChart', function ($routeParams, $scope, configChart) {

			$scope.categoryId = $routeParams.categoryId;
			$scope.goalId     = $routeParams.goalId;

			var ctx = document.getElementById("smu-chart-0").getContext("2d");

			var data = {
				labels: ["January", "February", "March", "April", "May", "June", "July"],
				datasets: [
					{
						label: "My First dataset",
						fillColor: "rgba(220,220,220,0.5)",
						strokeColor: "rgba(220,220,220,0.8)",
						highlightFill: "rgba(220,220,220,0.75)",
						highlightStroke: "rgba(220,220,220,1)",
						data: [12, 10, 11, 9, 5, 3, 2]
					}
				]
			};

			var smuChart0 = new Chart(ctx).Bar(data, configChart.bar);

		}]);
})();

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

;(function () { 'use strict';

	angular.module('smuControllers').
		controller('MainCtrl', ['$scope', '$timeout', '$mdBottomSheet', function ($scope, $timeout, $mdBottomSheet) {

			$scope.alert = '';
			$scope.showGridBottomSheet = function($event) {
				$scope.alert = '';
				$mdBottomSheet.show({
					templateUrl: 'templates/partials/bottom-sheet.html',
					controller: 'BottomSheetCtrl',
					targetEvent: $event
				}).then(function(clickedItem) {
					$scope.alert = clickedItem.name + ' clicked!';
				});
			};
			//$scope.showGridBottomSheet();
		}]).
		controller('BottomSheetCtrl', function($scope, $mdBottomSheet) {
			$scope.items = [
				{ name: 'Hangout', icon: 'hangout' },
				{ name: 'Mail', icon: 'mail' },
				{ name: 'Message', icon: 'message' },
				{ name: 'Copy', icon: 'copy' },
				{ name: 'Facebook', icon: 'facebook' },
				{ name: 'Twitter', icon: 'twitter' },
			];
			$scope.listItemClick = function($index) {
				var clickedItem = $scope.items[$index];
				//$mdBottomSheet.hide(clickedItem);
			};
		}).
		controller('LeftCtrl', function($scope, $timeout, $mdSidenav, $log) {
			$scope.close = function() {
				$mdSidenav('left').close()
					.then(function(){
						$log.debug("close LEFT is done");
					});
			};
		});

})();

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

;(function () {
	'use strict';

	angular.module('smuDirectives').
		directive('smuMatchModel', ['$log', '$parse', function ($log, $parse) {

			return {
				require: '^ngModel', // ngModel is required
				restrict: 'A',       // Attribute directive only
				link: function (scope, element, attrs, NgModelController) {

					var targetFunction = $parse(attrs.smuMatchModel);
					function targetValue() {
						return targetFunction(scope);
					}

					// Add new validator
					NgModelController.$validators.smuMatchModel = function () {
						return NgModelController.$viewValue === targetValue();
					};

					// Run all validators when targetValue changes.
					scope.$watch(targetValue, function () {
						NgModelController.$$parseAndValidate();
					});

				}

			};

		}]);

})();

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

;(function () { 'use strict';

	angular.module('smuFactories').
		factory('CompanyResourceFactory', [ '$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('companies/:companyId'),
				{
					companyId: '@companyId'
				}
			);

		}]);

})();

;(function () { 'use strict';

	angular.module('smuFactories').
		factory('InterestResourceFactory', ['$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('interest/:interestId'),
				{
					categoryId: '@categoryId'
				}
			);

		}]);

})();

;(function () { 'use strict';

	angular.module('smuFactories').
		factory('LocationResourceFactory', [ '$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('locations/:locationId'),
				{
					locationId: '@id'
				}
			);

		}]);

})();

;(function () { 'use strict';

	angular.module('smuFactories').
		factory('StatisticResourceFactory', [ '$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('statistics/:statisticId'),
				{
					statisticId: '@statisticId'
				}
			);

		}]);

})();

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

;(function () { 'use strict';

	angular.module('smuFactories').
		factory('UserResourceFactory', ['$resource', 'apiUriFactory', function ($resource, apiUriFactory) {

			// https://code.angularjs.org/1.3.15/docs/api/ngResource/service/$resource
			return $resource(
				apiUriFactory.make('users/:userId'),
				{
					userId: '@userId'
				}
			);

		}]);

})();

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

//# sourceMappingURL=frontoffice.js.map