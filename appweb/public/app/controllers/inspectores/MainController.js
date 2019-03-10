app.controller('Inspectores_MainController', function ($scope, Region) {

	$scope.selected = {};

	$scope.update = {
		persona: {},
	};

	$scope.activos = [
        { id: 1, name: 'Si' },
        { id: 0, name: 'No' },
    ];
});
