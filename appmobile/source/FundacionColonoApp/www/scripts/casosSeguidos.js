$(document).ready(function () {
    llenarCasosSegudidos();
});

function llenarCasosSegudidos() {

    $.ajax({
        url: $direccionServicios + 'historicoMobile/index',
        type: 'GET',
        dataType: 'json',
        data: {},
        cache: false,
        success: function (msg, status, jqXHR) {

            $listaExpedientes = msg.expedientes;
            

            console.log($listaExpedientes);

        }
    });

}