app.controller('Inspectores_IndexController', function($scope, Inspector, Visita, Region, Typeahead, Modal) {

	var showModal = Modal.init('#show_modal', {
		style: { 'overflow-y': 'hidden', 'bottom': '0' },
		onBeforeShow: function () { $('body').css('overflow-y', 'hidden'); },
		onBeforeClose: function () { $('body').css('overflow-y', 'auto'); },
	});

	$scope.total = 1;
	$scope.page = 1;

	$scope.totalExpediente = 1;
	$scope.pageExpediente  = 1;

	$scope.filter_data = {
		value:     '',
		filter:    null,
		active: false,
		filtered: false,
		one:      false,
		activo:   $scope.activos[0],
	};

	$scope.inspectores = [];
	$scope.expedientes = [];

	$scope.columns = {
			cedula:        			true,
			nombre:        			true,
			apellidos:     			true,
			ubicacion:     			true,
			email:         			true,
			activo:        			true,
			
			cedulaVisita:        	true,
			nombreVisita:        	true,
			apellidosVisita:     	true,
			ubicacionVisita:     	true,
			observacionesVisita: 	true,
			fecha_visitaVisita:  	true,
			fecha_asignadoVisita:  	true,
			removerVisita: 	 	 	true, 
	
			cedulaAsignar:       	true,
			nombreAsignar:        	true,
			apellidosAsignar:     	true,
			ubicacionAsignar:     	true,
			estadoAsignar:     		true,
			prioridadAsignar: 		true,
			fecha_creacionAsignar:  true,
			agregarAsignar: 		true, 
	};

	$scope.sort = {
		relationship: 'persona',
		by: 'cedula',
		order: true,
	};

	$scope.filter_init = function () {
		if (!$scope.filter_data.active) {
			$scope.filter_data.active = true;
		}
	};

	$scope.doSort = function (by) {
		$scope.sort.order = ($scope.sort.by === by) ? !$scope.sort.order : true;
		$scope.sort.by = by;

		switch ($scope.sort.by) {
				case 'cedula':
				case 'nombre':
				case 'apellidos':
				case 'ubicacion':
					$scope.sort.relationship = 'persona'
					break;
				 case 'activo':
					 $scope.sort.relationship = 'inspectores'
				     break;
				 case 'estado':
					 $scope.sort.relationship = 'expediente'
				     break;
				default:
					$scope.sort.relationship = 'usuario'
		}
		$scope.index();
	  };

	 $scope.index = function (page = 1){
		$scope.page = page;

		var params = {
			relationship: $scope.sort.relationship,
			order:        $scope.sort.order ? 'asc': 'desc',
			page:         $scope.page,
			by:           $scope.sort.by,
			filter: 	  !$scope.filter_data.active ? '' : $scope.filter_data.activo.id,
		};

		Inspector('all').get(
			params,
			function (response) {
				$scope.inspectores = response.inspectores;
				$scope.total = response.total;
		});

		Visita.get(
			{},
			function (response) {
				$scope.expedientes = response.expedientes;
				$scope.totalExpediente = response.total;
		});

	};

	$scope.show = function (obj) {
		$scope.selected.isSelected = false;
		obj.isSelected = true;
		$scope.selected = obj;

		showModal.show();
	};


	$scope.filter_activo = function () {
	  $scope.search          = '',
      $scope.filter_data.one = true;
      $scope.filter_data.filtered = true;
      $scope.index($scope.page);
	};

	$scope.index();
});
