app.controller('Expedientes_MainController', function ($scope, Referente, Ayuda, Typeahead) {

    $scope.formatter = Typeahead.formatter;

    $scope.selected = {
        datePickers: {
            from: { date: null, open: false },
            to:   { date: null, open: false },
        },
        //* Attributes are populated when a record is selected
	};

    $scope.update = {
        caso:    {},
        persona: {},
        ayudas:  {
            attachs: [],
            detachs: [],
            updates: []
        }
    };

    //$scope.ayudas = Ayuda.all();

    Ayuda.get(
        function (response) {
            $scope.ayudas = response.ayudas;
        }
    );
    
    $scope.referentes = Referente.all();

    $scope.estados = [
        { id: 0, name: 'En valoración' },
        { id: 1, name: 'Aprobado' },
        { id: 2, name: 'No aprobado' },
        { id: 3, name: 'Pendiente' },
    ];

    $scope.prioridades = [
        { id: 1, name: 'Baja' },
        { id: 2, name: 'Media' },
        { id: 3, name: 'Alta' }
    ];
});
