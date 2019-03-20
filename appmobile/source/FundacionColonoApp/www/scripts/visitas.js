$(document).ready(function () {
    
    obtenerProvincias('Visita');
    llenarVisitas();

});

$('#sProvinciaVisita').change(function () {

    $provinciaSeleccionada = $('#sProvinciaVisita option:selected').text().trim();

    if ($provinciaSeleccionada == 'Provincia') {
        $('#tablaExpedientesVisitas tbody').find('tr').css('display', 'table-row');
    } else {
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + '"))').parent().css('display', 'none');
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + '")').parent().css('display', 'table-row');
    }

});

$('#sCantonVisita').change(function () {

    $catonSeleccionado = $('#sCantonVisita option:selected').text().trim();

    if ($catonSeleccionado == 'Cantón') {
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + '"))').parent().css('display', 'none');
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + '")').parent().css('display', 'table-row');
    } else {
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '"))').parent().css('display', 'none');
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '")').parent().css('display', 'table-row');
    }

});

$('#sDistritoVisita').change(function () {

    $distritoSeleccionado = $('#sDistritoVisita option:selected').text().trim();

    if ($distritoSeleccionado == 'Distrito') {
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '"))').parent().css('display', 'none');
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '")').parent().css('display', 'table-row');
    } else {
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + ', ' + $distritoSeleccionado + '"))').parent().css('display', 'none');
        $('#tablaExpedientesVisitas tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + ', ' + $distritoSeleccionado + '")').parent().css('display', 'table-row');
    }

});


function cambiartabDatosVisitas() {

    $('#contenedorDatosVisitas').css('display', 'none ');
    $('#contenedorDatosEditablesVisitas').css('display', 'block ');

}

function cambiartabDatosEditarVisitas() {

    $('#contenedorDatosVisitas').css('display', 'block ');
    $('#contenedorDatosEditablesVisitas').css('display', 'none');

}

function llenarVisitas() {

    $.ajax({
        url: $direccionServicios + 'visitasMobile/index',
        type: 'GET',
        dataType: 'json',
        data: { inspector_fk: $inspector.id, tipo: 'visita' },
        cache: false,
        success: function (msg, status, jqXHR) {

            $listaVisitas = new Array();

            $listaVisitas = $.map(msg.expedientes, function (value, index) {
                return [value];
            });

            if ($listaVisitas.length > 0) {

                $html = "";

                for (var i = 0; i < $listaVisitas.length; i++) {

                    $ubicacion = $listaVisitas[i].expediente.persona.ubicacion.split('/');
                    
                    $ubicacionTexto = $provincias[parseInt($ubicacion[0] - 1)].nombre + ', ' +
                        $provincias[parseInt($ubicacion[0] - 1)].cantones[parseInt($ubicacion[1] - 1)].nombre + ', ' +
                        $provincias[parseInt($ubicacion[0] - 1)].cantones[parseInt($ubicacion[1] - 1)].distritos[parseInt($ubicacion[2] - 1)].nombre;

                    $html +=
                        '<tr>' +
                        '<td class="ui-table-priority-1 ui-table-cell-hidden"> <a href="#" class="ui-btn ui-icon-edit ui-btn-icon-notext  ui-shadow-icon ui-corner-all" onclick="irEditarVisita(' + i + ')"></a> </td>' +
                        '<td class="ui-table-priority-2 ui-table-cell-hidden">' + $listaVisitas[i].expediente.persona.cedula + '</td>' +
                        '<td class="ui-table-priority-3 ui-table-cell-hidden">' + $listaVisitas[i].expediente.persona.nombre + " " + $listaVisitas[i].expediente.persona.apellidos + '</td>' +
                        '<td class="ui-table-priority-4 ui-table-cell-hidden">' + $ubicacionTexto + '</td>' +
                        '<td class="ui-table-priority-4 ui-table-cell-hidden">' + $listaVisitas[i].expediente.persona.direccion + '</td>' +
                        '<td class="ui-table-priority-5 ui-table-cell-hidden">' + $listaVisitas[i].expediente.persona.telefonos + '</td>' +
                        '<td class="ui-table-priority-6 ui-table-cell-hidden">' + obtenerPrioridad($listaVisitas[i].expediente.prioridad) + '</td>' +
                        '</tr >';

                }

                $('#tablaExpedientesVisitas tbody').html($html);
                $('#tablaExpedientesVisitas').table('refresh');

                $('#txtBuscadorVisita').parent().css('width', 'calc(100% - 140px)');
                $('.ui-table-columntoggle-btn').css('margin-top', '28px');
                $('.ui-table-columntoggle-btn').css('position', 'absolute');

                $('#tablaExpedientesVisitas-popup .ui-checkbox input')[0].click();
                $('#tablaExpedientesVisitas-popup .ui-checkbox input')[1].click();
                $('#tablaExpedientesVisitas-popup .ui-checkbox input')[2].click();

            } else {
                //poner que no hay informaciön disponible
            }

        }
    });

}

function buscarVisita() {

    $textoBuscarVisita = $('#txtBuscadorVisita').val();

    if ($textoBuscarVisita == '') {
        $('#tablaExpedientesVisitas tbody').find('tr').css('display', 'table-row');
    } else {
        $('#tablaExpedientesVisitas tbody').find('tr:not(:contains("' + $textoBuscarVisita + '"))').css('display', 'none');
        $('#tablaExpedientesVisitas tbody').find('tr:contains("' + $textoBuscarVisita + '")').css('display', 'table-row');
    }

}

function irEditarVisita(posicion) {

    $('#txtVisitasNombre').val($listaVisitas[posicion].expediente.persona.nombre);
    $('#txtVisitasApellidos').val($listaVisitas[posicion].expediente.persona.apellidos);
    $('#txtVisitasCedula').val($listaVisitas[posicion].expediente.persona.cedula);
    $('#txtVisitasDireccion').val($listaVisitas[posicion].expediente.persona.direccion);
    $('#txtVisitastelefono').val($listaVisitas[posicion].expediente.persona.telefonos);
    $('#txtVisitasPrioridad').val(obtenerPrioridad($listaVisitas[posicion].expediente.prioridad));
    
    $('#btnGuardarDatosVisitas').removeAttr('onclick');
    $('#btnGuardarDatosVisitas').attr('onclick', 'guardarDatosVisitas(' + posicion + ')');

    redireccionar('visitas.html#pageEditarVisitas');
}

function guardarDatosVisitas(posicion) {

    event.preventDefault();

    $fecha_visita = $('#dpFechaVisita').val();
    $observaciones = $('#txtObservacionVisita').val();

    if ($fecha_visita != '') {
        if ($observaciones != '') {

            $.ajax({
                url: $direccionServicios + 'visitasMobile/update',
                type: 'GET',
                dataType: 'json',
                data: { id: $listaVisitas[posicion].id, fecha_visita: $fecha_visita, observaciones: $observaciones },
                success: function (msg, status, jqXHR) {

                    if (msg.resultado) {
                        
                        alert('Se ha actualizado correctamente');
                        irVisitas();
                        location.reload();

                    } else {
                        alert('Error al actualizar datos');
                    }

                }
            });

        } else {
            alert('Colocar un observacion es necesario');
        }

    } else {
        alert('La fecha de la visita es necesario');
    }

}