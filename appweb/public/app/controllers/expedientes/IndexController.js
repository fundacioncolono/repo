
app.controller('Expedientes_IndexController', function ($scope, Expediente, Alert, Modal) {

	var showModal = Modal.init('#show_modal',{
		style:{ 'overflow-y': 'hidden', 'bottom': '0', 'left': '0' },
		onBeforeShow: function() {$('body').css('overflow-y', 'hidden');}
	});

	$scope.onlyTrashed = false;

	$scope.search = {
		property: 'cedula',
		value: '',
	};
	
	$scope.expedientes = [];

	$scope.filter_data = {
		value:          '',
		referente:      [],
		ayuda:          null,
		filter:         null,
		filtered:       false,
		one:            false,
		estado:         $scope.estados[0],
		prioridad:      $scope.prioridades[0],
		fecha_creacion: {from: new Date(), to: new Date()},
	};

	$scope.total = 1;
	$scope.page  = 1;

	$scope.sort = {
		relationship: 'persona',
		by:           'cedula',
		order:        true,
	};
	
	$scope.columns = {
		ayuda:          true,
		cedula:         true,
		nombre:         true,
		estado:         true,
		apellidos:      true,
		prioridad:      true,
		referente:      true,
		ubicacion:      true,
		fecha_creacion: true
	};

	$scope.doSort = function (by) {
		$scope.sort.order = ($scope.sort.by === by) ? !$scope.sort.order : true;
		$scope.sort.by = by;

		switch ($scope.sort.by) {
			case 'estado':
			case 'prioridad':
			case 'referentes':
			case 'fecha_creacion':
				$scope.sort.relationship = 'expedientes'
				break;

			default:
				$scope.sort.relationship = 'persona'
				
		}

		$scope.index();
	};

	$scope.filter_init = function(){
		if (!$scope.filter_data.active) {
			$scope.filter_data.referente = $scope.referentes[0];
			$scope.filter_data.ayuda = $scope.ayudas[0];
			$scope.filter_data.active = true;
		}
	};

	$scope.trashed = function(){
		$scope.onlyTrashed = !$scope.onlyTrashed;
		$scope.index();
	};

	$scope.all = function () {
		$scope.filter_data.filtered = false;
		$scope.filter_data.filter = null;
		$scope.search.term = '';
		$scope.index();
	};

	$scope.index = function (page = 1) {
		$scope.page = page;

		var params = {
			termProperty: $scope.search.property,
			onlyTrashed:  $scope.onlyTrashed,
			orderRel:     $scope.sort.relationship,
			order:        $scope.sort.order ? 'asc': 'desc',
			term:         $scope.search.value,
			page:         $scope.page,
			by:           $scope.sort.by,
		};

		if ($scope.filter_data.filtered){
			params.page = $scope.filter_data.one ? 1 : $scope.page;
			$scope.page = params.page;
			$scope.filter_data.one = false;

			params = angular.merge(params, jQueryToJson($('#filter'), 'name'));
		}

		Expediente('all').get(
			params,
			function(response){
				$scope.total       = response.total;
				$scope.expedientes = response.expedientes;
			});
	};

	$scope.show = function (obj) {
		$scope.selected.isSelected = false;
		obj.isSelected = true;
		$scope.selected = obj;

		showModal.show();

		if (obj.archivado)
			Alert.notify('Expediente archivado', 'No se pueden realizar cambios al expediente mientras esté archivado. ', 'info', 3000);
	};

	$scope.filter = function () {
		$scope.search.value          = '',
		$scope.filter_data.one      = true;
		$scope.filter_data.filtered = true;

		$scope.index($scope.page);
	};

	$scope.clear = function(){
		$scope.search.value = null;
		$scope.index();
	};

	$scope.index();
});
