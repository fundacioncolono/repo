app.controller('Usuarios_IndexController', function ($scope, Usuario,Typeahead) {
	$scope.opcion = 0;

	$scope.total = 1;
	$scope.page = 1;

	$scope.usuarios = [];

	$scope.columns = {
		username: true,
		email: true,
		opciones: true,
	};
	
	$scope.index = function (page = 1){
		$scope.page = page;

		Usuario.get(
			{page: $scope.page},
			function (response) {
				$scope.usuarios = response.usuarios;
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
		
			$scope.update.username = "";
			$scope.update.password = "";
			$scope.update.email = "";
			 
		}
		$('#modalOpcion').modal('show');
		
	};

	$scope.closeModal = function(){
		$scope.update.username = "";
		$scope.update.email = "";
		$('#modalOpcion').modal('hide');				
	}

	$scope.add = function(){
		Usuario.create(
			{ 
				username: $scope.update.username,
			  	password: $scope.update.password,
			  	email: $scope.update.email,
			 
			 }, 
			function(response){
				$scope.closeModal();
				$scope.index();
			}
		);
	}

	$scope.delete = function(){
		Usuario.delete(
			{ id: $scope.selected.id },
			function (response) {
				$scope.closeModal();
				$scope.index();
			}
		);
	}

	$scope.edit = function(){
		
		Usuario.save(
			{ 
				id: $scope.selected.id, 
			  	username: $scope.update.username,
			  	email: $scope.update.email
			},
			function (response) {
				$scope.closeModal();
				$scope.index();
			}
		);	
	}

	$scope.index();

});