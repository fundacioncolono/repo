$listaExpedientes = new Array();
$listaExpedientesAgregar = new Array();

$(document).ready(function () {

    $('#tabDatosUsuario').addClass('ui-btn-active');
    obtenerProvincias('Casos');
    llenarExpedientes();

});


$('#sProvinciaCasos').change(function () {

    $provinciaSeleccionada = $('#sProvinciaCasos option:selected').text().trim();

    if ($provinciaSeleccionada == 'Provincia') {
        $('#tablaExpedientes tbody').find('tr').css('display', 'table-row');
    } else {
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + '"))').parent().css('display', 'none');
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + '")').parent().css('display', 'table-row');
    }

});

$('#sCantonCasos').change(function () {

    $catonSeleccionado = $('#sCantonCasos option:selected').text().trim();

    if ($catonSeleccionado == 'Cantón') {
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + '"))').parent().css('display', 'none');
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + '")').parent().css('display', 'table-row');
    } else {
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '"))').parent().css('display', 'none');
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '")').parent().css('display', 'table-row');
    }

});

$('#sDistritoCasos').change(function () {

    $distritoSeleccionado = $('#sDistritoCasos option:selected').text().trim();

    if ($distritoSeleccionado == 'Distrito') {
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '"))').parent().css('display', 'none');
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + '")').parent().css('display', 'table-row');
    } else {
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:not(:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + ', ' + $distritoSeleccionado + '"))').parent().css('display', 'none');
        $('#tablaExpedientes tbody').find('tr .ui-table-priority-4:contains("' + $provinciaSeleccionada + ', ' + $catonSeleccionado + ', ' + $distritoSeleccionado + '")').parent().css('display', 'table-row');
    }

});

function asignarCasos() {

    $.ajax({
        url: $direccionServicios + 'visitasMobile/store',
        type: 'GET',
        dataType: 'json',
        data: { listaExpedientes: JSON.stringify($listaExpedientesAgregar), inspector_fk: $inspector.id },
        cache: false,
        success: function (msg, status, jqXHR) {

            if (msg.resultado == '1') {
                alert('Los cambios se realizaron correctamente');
                location.reload();
            } else {
                alert('Error al realizar los cambios');
            }

        }
    });

}

function llenarExpedientes(accion) {

    $.ajax({
        url: $direccionServicios + 'expedientesMobile/index',
        type: 'GET',
        dataType: 'json',
        data: {},
        cache: false,
        success: function (msg, status, jqXHR) {

            $listaExpedientes = msg.expedientes;

            if ($listaExpedientes.length > 0) {

                $html = "";

                for (var i = 0; i < $listaExpedientes.length; i++) {

                    $ubicacion = $listaExpedientes[i].persona.ubicacion.split('/');

                    $ubicacionTexto = $provincias[parseInt($ubicacion[0] - 1)].nombre + ', ' +
                        $provincias[parseInt($ubicacion[0] - 1)].cantones[parseInt($ubicacion[1] - 1)].nombre + ', ' +
                        $provincias[parseInt($ubicacion[0] - 1)].cantones[parseInt($ubicacion[1] - 1)].distritos[parseInt($ubicacion[2] - 1)].nombre;


                    $html +=
                        '<tr>' +
                        '<td class="ui-table-priority-1 ui-table-cell-hidden"> <input class="ckGeneral" type="checkbox" id="ckAsignarCaso' + i + '" onclick="asignarCaso(' + i + ')" /> </td>' +
                        '<td class="ui-table-priority-2 ui-table-cell-hidden">' + $listaExpedientes[i].persona.cedula + '</td>' +
                        '<td class="ui-table-priority-3 ui-table-cell-hidden">' + $listaExpedientes[i].persona.nombre + " " + $listaExpedientes[i].persona.apellidos + '</td>' +
                        '<td class="ui-table-priority-4 ui-table-cell-hidden">' + $ubicacionTexto + '</td>' +
                        '<td class="ui-table-priority-4 ui-table-cell-hidden">' + $listaExpedientes[i].persona.direccion + '</td>' +
                        '<td class="ui-table-priority-5 ui-table-cell-hidden">' + $listaExpedientes[i].persona.telefonos + '</td>' +
                        '<td class="ui-table-priority-6 ui-table-cell-hidden">' + obtenerPrioridad($listaExpedientes[i].prioridad) + '</td>' +
                        '</tr>';

                }

                $('#tablaExpedientes tbody').html($html);
                $('#tablaExpedientes').table('refresh');
                $('.ui-table-columntoggle-btn').css('margin-top', '70px');
                $('.ui-table-columntoggle-btn').css('position', 'absolute');

                $('#tablaExpedientes-popup .ui-checkbox input')[0].click();
                $('#tablaExpedientes-popup .ui-checkbox input')[1].click();
                $('#tablaExpedientes-popup .ui-checkbox input')[2].click();

            } else {
                //poner que no hay informaciön disponible
            }

        }
    });

}

function asignarCaso(posicion) {

    if ($('#ckAsignarCaso' + posicion + ':checked').val() == 'on') {
        $listaExpedientesAgregar.push($listaExpedientes[posicion]);
    } else {
        eliminarCaso($listaExpedientesAgregar, posicion);
    }

}

function eliminarCaso(lista, posicion) {

    for (var i = 0; i < lista.length; i++) {

        if (lista[posicion].id == lista[i].id) {
            lista.splice(i);
        }

    }

}

function buscarCaso() {

    $textoBuscarCaso = $('#txtBuscadorCaso').val();

    if ($textoBuscarCaso == '') {
        $('#tablaExpedientes tbody').find('tr').css('display', 'table-row');
    } else {
        $('#tablaExpedientes tbody').find('tr:not(:contains("' + $textoBuscarCaso + '"))').css('display', 'none');
        $('#tablaExpedientes tbody').find('tr:contains("' + $textoBuscarCaso + '")').css('display', 'table-row');
    }

}