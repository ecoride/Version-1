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
