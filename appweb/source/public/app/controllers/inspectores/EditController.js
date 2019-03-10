app.controller('Inspectores_EditController', function ($scope, Inspector, Visita, Alert, Typeahead, Modal) {

	var modal = Modal.getInstance(),
	hasUncommitted = function () {
	  return true;
	};

	$scope.ver = 'mostrar';

  $scope.invalid_add = false;

	$scope.cantones = [];
	$scope.distritos = [];

	$scope.edit = function (){
	  $scope.selected.editable = true;
	};

	$scope.mostrar = function (){
		if( $scope.ver == 'mostrar' )
			$scope.ver = 'asignar';
		else
			$scope.ver = 'mostrar';
	};

  	$scope.delete = function () {
  		Alert.confirm('Desactivar inspector', 'Esta operación pasará al inspector a estado inactivo.', 'warning')
		.then(function (result) {
			if ( result.value )
				Inspector().update(
					{ id: $scope.selected.id, activo: $scope.selected.activo },
					function (response) {
						if (response.status) {
							$scope.inspectores.splice(getIndex($scope.inspectores, $scope.selected), 1);
	                        if ($scope.page !== response.last && $scope.inspectores.length > 0) 
	                            $scope.index($scope.page);
	                        else if ($scope.inspectores.length === 0)
								$scope.index($scope.page - 1);
							modal.close(true, function () { $('body').css('overflow-y', 'auto'); });
						}
						Alert.notify(response.title, response.msg, response.type);
					}
				);
		});
	};

	$scope.alertDelete = function (v) {
		Alert.confirm('Remover expediente asignado', 'Esta operación removerá el expidiente asignado al inspector.', 'warning')
		.then( function (result) {
			if ( result.value )
				Visita.delete(
					{ id: v.id },
					function (response) {
						if (response.status) {

							for( var i = 0; i < $scope.selected.visitas.length; i++ ){
								if( $scope.selected.visitas[i].id === v.id ){
									$scope.selected.visitas.splice( i  , 1 );
									i = $scope.selected.visitas.length;
								}
							}  
								
						}
						Alert.notify(response.title, response.msg, response.type);
					}
				);
		});
	};


	$scope.asignar = function(e, index){
		Visita.create(
			{ inspector_fk: $scope.selected.id , expediente_fk: e.id },
			function (response) {
				if (response.status) {
					$scope.expedientes.splice( index, 1 );
					$scope.selected.visitas = response.visitas;
				}
				Alert.notify(response.title, response.msg, response.type);
			}
		);
	}

	$scope.indexExpediente = function (pageExpediente = 1){
		
		$scope.pageExpediente = pageExpediente;

		Visita.get(
			{ page: $scope.pageExpediente },
			function (response) {
				$scope.expedientes = response.expedientes;
				$scope.totalExpediente = response.total;
		});

		window.alert($scope.pageExpediente);
	};

});
