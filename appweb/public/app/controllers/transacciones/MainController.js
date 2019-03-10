app.controller('Transacciones_MainController', function ($scope, Transaccion) {

    $scope.transactions = [];

    $scope.index = function() {
        Transaccion('all').all(function (data) {
            $scope.transactions = data;
        });
    };

    $scope.dismiss = function (index) {
        $scope.transactions.splice(index, 1);
    };

    $scope.collapse = function (e){
        var collapsible = $(e.target).parent().next();

        if (collapsible.is(':hidden')) 
            collapsible.slideDown(300);
        else collapsible.slideUp(300);
    };

    $scope.index();
});