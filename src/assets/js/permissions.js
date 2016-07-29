var lastChecked = null;

$(document).ready(function() {
    var $chkboxes = $('.permission-checkbox');
    $chkboxes.click(function(e) {
        if(!lastChecked) {
            lastChecked = this;
            return;
        }

        if(e.shiftKey) {
            var start = $chkboxes.index(this);
            var end = $chkboxes.index(lastChecked);
            var index=1;
            $chkboxes.slice(Math.min(start,end), Math.max(start,end)+ 1).each(function(e){
                if(index%2==1)
                    $(this).prop('checked', lastChecked.checked);
                index++;
            });

        }

        lastChecked = this;
    });
});
(function() {

    app.controller("permissionsController", permissionsController);
    permissionsController.$inject = ["$scope","$http"];

    function permissionsController($scope,$http) {
        $scope.permissions=[];
        $scope.savePermissions=function(){
            console.log($scope.permissions);
            $http.post('/api/save-permissions',{data:[$scope.permissions,'b']}).then(function(response){
                console.log(response.data);
            });
        };
        /*$scope.cols=[
            { field: "name", title: "Kısa Adı",show: true },
            { field: "display_name", title: "Adı",show: true },
            { field: "description", title: "Tanımı",show: true }
        ];
        $scope.getPermissions=function(){
            $http.get('/permissions').then(function(response){
                //$scope.tableParams=response.data;
                $scope.tableParams=new NgTableParams({},{
                    dataset:response.data
                })
            });
        };*/
        //$scope.getPermissions();
        /*$scope.savePermission=function(){
            $http.post('/permissions',$scope.newPermission).then(function successCallback(response) {
                $scope.getRoles();
                $scope.errors={};
                $scope.newPermission={};
            }, function errorCallback(response) {
                $scope.errors=response.data;
            });
        }*/
    }
})();