app.controller('Expedientes_EditController', function ($scope, $filter, Expediente) {
	
	$scope.estado = $scope.estados[0];
	
	$scope.edit = function (){
		copy($scope.selected, $scope.update.caso, ['persona', 'ayudas']);

		$scope.update.caso.estado_selected    = find('id', $scope.update.caso.estado, $scope.estados);
		$scope.update.caso.prioridad_selected = find('id', $scope.update.caso.prioridad, $scope.prioridades);
		$scope.update.caso.referente_selected = !angular.equals($scope.selected.referente, $scope.referentes[0]) ? $scope.selected.referente.id : null;
		$scope.update.caso.datePickers = {
			from: {
				date: $scope.update.caso.fecha_desde ? new Date($scope.update.caso.fecha_desde) : new Date(),
				open: false
			},
			to: { 
				date: $scope.update.caso.fecha_hasta ? new Date($scope.update.caso.fecha_hasta) : new Date(),
				open: false 
			}
		} || $scope.update.caso.datePickers;

		$scope.update.caso.datePickerOptions = {
			from: {minDate: new Date()},
			to: {minDate: $scope.update.caso.datePickers.from.date}
		} || $scope.update.caso.datePickerOptions;

		$scope.selected.editable = true;
	};

	$scope.commit = function(){
		
		// Save current state
		$scope.update.cache = $scope.update.cache || angular.copy($scope.selected);

		// parse attributes...
		$scope.update.caso.estado      = $scope.update.caso.estado_selected.id;
		$scope.update.caso.prioridad   = $scope.update.caso.prioridad_selected.id;
		$scope.update.caso.referente   = find('id', $scope.update.caso.referente_selected, $scope.referentes) || $scope.referentes[0];
		$scope.update.caso.fecha_desde = $scope.update.caso.estado === 1 ? $scope.update.caso.datePickers.from.date.toStandardDate() : null;
		$scope.update.caso.fecha_hasta = $scope.update.caso.estado === 1 ? $scope.update.caso.datePickers.to.date.toStandardDate() : null;

        copy($scope.update.caso, $scope.selected);

		$scope.selected.editable = false
	};

	$scope.revert = function(){
		copy($scope.update.cache, $scope.selected);

		delete $scope.update.cache;
		$scope.update.caso = {};

		$scope.selected.editable = false;
	};

});
