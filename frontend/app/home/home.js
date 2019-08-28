'use strict';

angular.module('tickets4saleApp.home', ['ngRoute'])

.config(['$routeProvider', function($routeProvider) {
  $routeProvider.when('/', {
    templateUrl: 'home/home.html',
    controller: 'HomeCtrl',
    service: 'ShowService'
  });
}])

.controller('HomeCtrl', ['$scope','$filter','ShowService', function($scope,$filter,$ShowService) {
  $scope.showDate=  $filter('date')(new Date(), "yyyy-MM-dd");
  $scope.musicalShows=[];
  $scope.comedyShows=[];
  $scope.dramaShows=[];
  
  let api = "/api/shows";

  $scope.getShows = function(){
    var dateValidator = new RegExp(/([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))/);
    if(dateValidator.test($scope.showDate)){
      $ShowService.getShows(api,$scope.showDate).then(res=>{
        $scope.musicalShows = res.inventory.find(x=>x.genre == "musical").shows;
        $scope.comedyShows = res.inventory.find(x=>x.genre == "comedy").shows;
        $scope.dramaShows = res.inventory.find(x=>x.genre == "drama").shows;
      }).catch(err=>{
        console.error(err);
      });
    }else{
      alert("Invalid Date Format");
    }
  };
  $scope.getShows();
}])
.service('ShowService', ['$http', function($http) {
  return {
      getShows: getShows
  };
  function getShows($url,$showDate) {
    return $http.get($url, {params:{"show-date": $showDate}})
          .then(getShowsComplete).catch(getShowsFailed);

    function getShowsComplete(response) {
        return response.data;
    }

    function getShowsFailed(error) {
        return "error";
    }
  }
}]);