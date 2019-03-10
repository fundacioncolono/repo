app.controller('Expedientes_CreateController', function ($scope, Persona) {

	$scope.items = [];
	$scope.invalid = false;
	$scope.estado = $scope.estados[0];

	$scope.datePickers = {
		from: { open: false, date: new Date() },
		to: { open: false, date: null },
	};
	$scope.datePickerOptions = {
		from: { minDate: new Date() },
		to: { minDate: $scope.datePickers.from.date }
	};

	$scope.validate = function () {
		Persona.get({ cedula: $scope.cedula }, function (data) {
			$scope.invalid = !!data.cedula;
		});
	};

	$scope.remove = function (index) {
		// remove item
		$scope.items.splice(index, 1);
	};
});
