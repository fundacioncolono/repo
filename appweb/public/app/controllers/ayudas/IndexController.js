app.controller('Ayudas_IndexController', function ($scope, Ayuda,Typeahead) {

	$scope.opcion = 0;

	$scope.total = 1;
	$scope.page = 1;

	$scope.ayudas = [];

	$scope.columns = {
		descripcion: true,
		opciones: true,
	};
	
	$scope.index = function (page = 1){
		$scope.page = page;

		Ayuda.get(
			{page: $scope.page},
			function (response) {
				$('#modalOpcion').modal('hide');
				$scope.ayudas = response.ayudas;
				$scope.total = response.total;
			}
		);
	};

	$scope.show = function (obj, opc) {
		$scope.opcion = opc;
		
		if($scope.opcion !== 0){
			
			$scope.selected.isSelected = false;
			obj.isSelected = true;
			$scope.selected = obj;
			copy($scope.selected, $scope.update);
		}else{
			$scope.update.descripcion = '';
		}
	};

	$scope.closeModal = function(){
		$scope.update.descripcion = '';
		$('#modalOpcion').modal('hide');
				
	}

	$scope.add = function(){
		Ayuda.create(
			{ descripcion: $scope.update.descripcion }, 
			function(response){
				$scope.closeModal();
				$scope.index();
			}
		);
	}

	$scope.delete = function(){
		Ayuda.delete(
			{ id: $scope.selected.id },
			function (response) {
				$scope.closeModal();
				$scope.index();
			}
		);
	}

	$scope.edit = function(){
		Ayuda.save(
			{ id: $scope.selected.id, 
			  ayuda: $scope.update
			},
			function (response) {
				$scope.closeModal();
				$scope.index();
			}
		);	
	}

	$scope.index();

});