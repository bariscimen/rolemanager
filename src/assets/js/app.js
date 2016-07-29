var app = angular.module("myApp", ["ngTable", "ngResource","xeditable","checklist-model"]);
    /*.config(function($interpolateProvider){
        $interpolateProvider.startSymbol('<%').endSymbol('%>');
    });*/
/*app.config(['$resourceProvider', function($resourceProvider) {
    // Don't strip trailing slashes from calculated URLs
    $resourceProvider.defaults.stripTrailingSlashes = false;
}]);*/
app.run(function(editableOptions) {
    editableOptions.theme = 'bs3'; // bootstrap3 theme. Can be also 'bs2', 'default'
});