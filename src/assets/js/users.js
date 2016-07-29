(function() {

    app.controller("usersController", usersController);
    usersController.$inject = ["NgTableParams","$resource","$scope","$http","$filter"];

    function usersController(NgTableParams,$resource,$scope,$http,$filter) {
        $scope.newUser={};
        $scope.getEverything=function(){
            var Api = $resource("/api/users");
            $scope.tableParams = new NgTableParams({
                page: 1, // show first page
                count: 10 // count per page
            }, {
                filterDelay: 0,
                getData: function(params) {
                    // ajax request to api
                    return Api.get(params.url()).$promise.then(function(data) {
                        params.total(data.inlineCount);
                        $scope.yetkiler=data.yetkiler;
                        $scope.filter_yetkiler=data.filter_yetkiler;
                        console.log($scope.filter_yetkiler);
                        return data.results;
                    });
                }
            });
        };
        $scope.getEverything();
        $scope.saveUser=function(){
            return $scope.newEntity; // kaydey ve $scope.getEverything();
        };
        $scope.showStatus = function(yetki) {
            var selected = [];
            angular.forEach($scope.yetkiler, function(s) {
                if (yetki.indexOf(s.id) >= 0) {
                    selected.push(s.display_name);
                }
            });
            return selected.length ? selected.join(', ') : 'Yok';
        };
        $scope.updateYetki=function(id,yetkiler){
            $http.post('/api/update-roles/'+id,yetkiler).then(function(){});
        }

    }
})();