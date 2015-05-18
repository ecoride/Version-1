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
