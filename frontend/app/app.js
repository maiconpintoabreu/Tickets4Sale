'use strict';
// Declare app level module which depends on views, and core components
angular.module('tickets4saleApp', [
  'ngRoute',
  'tickets4saleApp.home',
  
]).
config(['$locationProvider', '$routeProvider', function($locationProvider, $routeProvider) {
  $locationProvider.hashPrefix('!');
  $routeProvider.otherwise({redirectTo: '/'});
}]);
