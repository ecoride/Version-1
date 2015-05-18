var elixir = require('laravel-elixir');

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Less
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir.config.cssOutput     = 'public/styles/css/';   // Override default 'public/css'
elixir.config.jsOutput      = 'public/scripts/js/';   // Override default 'public/js/'
elixir.config.fontsOutput   = 'public/styles/fonts/'; // New
elixir.config.output        = 'public/';              // New
elixir.config.assetsBaseDir = 'resources/assets/';    // New
elixir.config.jsBaseDir     = './';                   // New

var vendor = {
		angular			: elixir.config.bowerDir + '/angular/angular.js',
		angularModule	: {
			animate		: elixir.config.bowerDir + '/angular-animate/angular-animate.js',
			aria		: elixir.config.bowerDir + '/angular-aria/angular-aria.js',
			cookies		: elixir.config.bowerDir + '/angular-cookies/angular-cookies.js',
			material	: elixir.config.bowerDir + '/angular-material/',
			messages	: elixir.config.bowerDir + '/angular-messages/angular-messages.js',
			resource	: elixir.config.bowerDir + '/angular-resource/angular-resource.js',
			route		: elixir.config.bowerDir + '/angular-route/angular-route.js',
			sanitize	: elixir.config.bowerDir + '/angular-sanitize/angular-sanitize.js',
			touch		: elixir.config.bowerDir + '/angular-touch/angular-touch.js'
		},
		bootstrap		: elixir.config.bowerDir + '/bootstrap-sass-official/assets/',
		chartjs			: elixir.config.bowerDir + '/chartjs/Chart.min.js',
		fontawesome		: elixir.config.bowerDir + '/fontawesome/',
		jquery			: elixir.config.bowerDir + '/jquery/dist/',
		leaflet			: elixir.config.bowerDir + '/leaflet/dist/',
		lodash			: elixir.config.bowerDir + '/lodash/lodash.min.js'
	},
	options = {
		sass: {
			includePaths: [
				vendor.bootstrap   + 'stylesheets/',
				vendor.fontawesome + 'scss/'
			]
		}
	};

elixir(function(mix) {
	mix
		// AngularJS (https://angularjs.org) + AngularJS Modules
		.copy(
			vendor.angularModule.material + 'angular-material.css',
			elixir.config.cssOutput       + 'angular.css'
		)
		.scripts([
				vendor.angular,
				vendor.angularModule.animate,
				vendor.angularModule.aria,
				vendor.angularModule.material + 'angular-material.js',
				vendor.angularModule.messages,
				vendor.angularModule.resource,
				vendor.angularModule.route
			],
			elixir.config.jsOutput + 'angular.js',
			elixir.config.jsBaseDir
		)

		// Chart.js (http://www.chartjs.org)
		.copy(
			vendor.chartjs,
			elixir.config.jsOutput + 'chart.js'
		)

		// Leaflet (http://leafletjs.com)
		.copy(
			vendor.leaflet          + 'leaflet.css',
			elixir.config.cssOutput + 'leaflet.css'
		)
		.copy(
			vendor.leaflet         + 'leaflet.js',
			elixir.config.jsOutput + 'leaflet.js'
		)

		// LoDash (https://lodash.com)
		.copy(
			vendor.lodash,
			elixir.config.jsOutput + 'lodash.js'
		)

		// App
		.sass([
				'backoffice.scss',
				'frontoffice.scss',
				'styleguide.scss'
			],
			elixir.config.cssOutput,
			options.sass
		)
		.copy(
			vendor.fontawesome + 'fonts/',
			elixir.config.fontsOutput
		)
		.copy(
			vendor.bootstrap + 'fonts/bootstrap/',
			elixir.config.fontsOutput
		)
		.copy(
			elixir.config.assetsBaseDir + 'html/',
			elixir.config.output
		)
		.copy(
			elixir.config.assetsBaseDir + 'images/',
			elixir.config.output        + 'images/'
		)
		.scripts([
				vendor.jquery    + 'jquery.js',
				vendor.bootstrap + 'javascripts/bootstrap.js'
			],
			elixir.config.jsOutput + 'backoffice.js',
			elixir.config.jsBaseDir
		)
		.scripts([
				elixir.config.assetsBaseDir + 'js/frontoffice/**/*.js'
			],
			elixir.config.jsOutput + 'frontoffice.js',
			elixir.config.jsBaseDir
		)
		.scripts([
				elixir.config.assetsBaseDir + 'js/styleguide/**/*.js'
			],
			elixir.config.jsOutput + 'styleguide.js',
			elixir.config.jsBaseDir
		)
		//.phpUnit()
		//.phpSpec()
	;
});
