(function() {

    app.controller("rolesController", rolesController);
    rolesController.$inject = ["NgTableParams","$scope","$http"];

    function rolesController(NgTableParams,$scope,$http) {
        $scope.newRole={};
        $scope.cols=[
        { field: "name", title: "Kısa Adı",show: true },
        { field: "display_name", title: "Adı",show: true },
        { field: "description", title: "Tanımı",show: true }
        ];
        $scope.getRoles=function(){
            $http.get('/roles').then(function(response){
                //$scope.tableParams=response.data;
                $scope.tableParams=new NgTableParams({},{
                    dataset:response.data
                })
            });
        };
        $scope.getRoles();
        $scope.saveRole=function(){
            $http.post('/roles',$scope.newRole).then(function successCallback(response) {
                $scope.getRoles();
                $scope.errors={};
                $scope.newRole={};
            }, function errorCallback(response) {
                $scope.errors=response.data;
            });
        }
    }
})();