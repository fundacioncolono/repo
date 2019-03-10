
/*
*   Controller for entity 'Expediente'
*/
app.controller('Personas_EditController', function ($scope, Alert, Persona) {

    $scope.edit = function () {
        $scope.selected.persona.editable = true;
        copy($scope.selected.persona, $scope.update.persona);
    };

    // Mostrar notificacion de la operacion
    $scope.updatePersona = function () {

        Persona.save(
            {
                cedula: $scope.selected.persona.cedula,
                persona: $scope.update.persona,
            },
            function (response) {
                if (response.status) {
                    $scope.selected.persona = response.persona
                    $scope.update.persona = {};
                }

                Alert.notify(response.title, response.msg, response.type);
            }
        );
    };

});
