var app = angular.module('app1', ['ngMaterial']);

app.controller('mainController', ['$scope','$log','$mdUtil','$mdSidenav','$timeout','$mdDialog','$mdBottomSheet', function ($scope, $log, $mdUtil, $mdSidenav, $timeout, $mdDialog, $mdBottomSheet) {
		$scope.toggle = false;
      $scope.data = {
        cb1: true,
      };
}]);






