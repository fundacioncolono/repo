$(document).ready(function () {

    $direccionServicios = 'http://localhost:5001/fundacioncolono/src/public/api/';
    $direccionServidor = 'http://localhost:4400/';

    if (window.localStorage.length == 4) {

        $usuario = JSON.parse(localStorage['usuario']);
        $persona = JSON.parse(localStorage['persona']);
        $inspector = JSON.parse(localStorage['inspector']);
        $provincias = JSON.parse(localStorage['provincias']);

    } else {

        obtenerProvinciasTodas();
        obtenerCantonesTodos();
        obtenerDistritosTodos();

    }

    $('.contenedorMenu').html(
        '<h1 class="tituloMenu">Menu</h1>' +
        '<a onclick="irInicio()" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-right btn-menu">Inicio</a>' +
        '<a onclick="irPagePerfil()" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-right btn-menu">Perfil</a>' +
        '<a onclick="irVisitas()" href="#" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-right btn-menu">Visitas</a>' +
        '<a onclick="irCasos()" href="#" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-right btn-menu">Casos</a>' +
        '<a onclick="irCasosSeguidos()" href="#" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-right btn-menu">Casos seguidos</a>' +
        '<a onclick="irCasosAprobados()" href="#" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-r ui-btn-icon-right btn-menu">Casos Aprobados</a>' +
        '<a onclick="irLogin()" class="btnMenu ui-btn ui-corner-all ui-icon-arrow-l ui-btn-icon-right btn-menu">Salir</a>'
    );

});

function irPagePerfil() {
    redireccionar('perfil.html#pagePerfil');
}

function irLogin() {
    localStorage.clear();
    redireccionar('index.html#pageLogin');
}

function irInicio() {
    redireccionar('Inicio.html#pageInicio');
}

function irCasos() {
    redireccionar('casos.html#pageCasos');
}

function irVisitas() {

    $('.contenedorMenu').removeClass("contenedorMenu menuAbierto").addClass("contenedorMenu");
    $('.contenedorMenu').css('visibility', 'hidden');

    redireccionar('visitas.html#pageVisitas');
}

function irCasosSeguidos() {
    redireccionar('casosSeguidos.html#pageCasosSeguidos');
}

function irCasosAprobados() {
    redireccionar('casosAprobados.html#pageCasosAprobados');
}

function abrirCerrarMenu() {

    if ($('.contenedorMenu').attr('class') == 'contenedorMenu menuAbierto') {

        $('.contenedorMenu').removeClass("contenedorMenu menuAbierto").addClass("contenedorMenu");
        $('.contenedorMenu').css('visibility', 'hidden');
        $('.contenedorMenu').css('opacity', '0');
        $('.contenedorMenu').css('transition', 'visibility 0s 1s, opacity 1s linear');

    } else {

        $('.contenedorMenu').addClass("menuAbierto");
        $('.contenedorMenu').css('visibility', 'visible');
        $('.contenedorMenu').css('opacity', '1');
        $('.contenedorMenu').css('transition', 'opacity 1s linear');

    }

}

function redireccionar(ruta) {

    //$('.contenedorMenu').removeClass("contenedorMenu menuAbierto").addClass("contenedorMenu");
    //$('.contenedorMenu').css('visibility', 'hidden');

    //$('#redireccionar').attr('href', ruta);
    //$('#redireccionar').click();
    window.location.href = $direccionServidor + ruta;

}

function showHidePassword() {

    var x = document.getElementById("txtContrasena");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

}

function obtenerProvinciasTodas() {

    $.ajax({
        dataType: "json",
        url: "https://ubicaciones.paginasweb.cr/provincias.json",
        data: {},
        async: false,
        success: function (data) {

            $contador = 1;
            $provincias = [];

            $provincias = $.map(data, function (element) {

                $elemento = {};
                $elemento.codigo = $contador;
                $elemento.nombre = element;
                $elemento.cantones = [];
                $contador = $contador + 1;
                return $elemento;

            });

        }
    });

}


function obtenerCantonesTodos() {

    for (var i = 0; i < $provincias.length; i++) {

        $.ajax({
            dataType: "json",
            url: "https://ubicaciones.paginasweb.cr/provincia/" + parseInt($provincias[i].codigo) + "/cantones.json",
            data: {},
            async: false,
            success: function (data) {

                $contador = 1;
                $provincias[i].cantones = $.map(data, function (element) {

                    $elemento = {};
                    $elemento.codigo = $contador;
                    $elemento.nombre = element;
                    $elemento.distritos = [];
                    $contador = $contador + 1;
                    return $elemento;

                });

            }
        });

    }


}

function obtenerDistritosTodos() {

    for (var i = 0; i < $provincias.length; i++) {
        for (var e = 0; e < $provincias[i].cantones.length; e++) {

            $.ajax({
                dataType: "json",
                url: "https://ubicaciones.paginasweb.cr/provincia/" + parseInt($provincias[i].codigo) + "/canton/" + parseInt($provincias[i].cantones[e].codigo) + "/distritos.json",
                data: {},
                async: false,
                success: function (data) {

                    $contador = 1;
                    $provincias[i].cantones[e].distritos = $.map(data, function (element) {

                        $elemento = {};
                        $elemento.codigo = $contador;
                        $elemento.nombre = element;
                        $contador = $contador + 1;
                        return $elemento;

                    });

                }
            });

        }

    }

    localStorage['provincias'] = JSON.stringify($provincias);

}


function obtenerProvincias(idSelect, codigosSeleccionar) {


    $('#sProvincia' + idSelect).html('');

    $('#sProvincia' + idSelect).attr('onchange', 'obtenerCantones("' + idSelect + '"' + ')');

    $('#sProvincia' + idSelect).append(
        '<option value="0">Provincia</option>'
    );

    for (var i = 0; i < $provincias.length; i++) {

        $('#sProvincia' + idSelect).append(
            '<option value="' + $provincias[i].codigo + '" >' + $provincias[i].nombre + ' </option>'
        );

    }

    if (typeof codigosSeleccionar != 'undefined') {

        $('#sProvincia' + idSelect + ' option[value="' + codigosSeleccionar[0] + '"]').attr("selected", "selected");
        $('#sProvincia' + idSelect + '-button').find('span').text($('#sProvincia' + idSelect + ' option:selected').text());
        obtenerCantones(idSelect, codigosSeleccionar);

    }


}

function obtenerCantones(idSelect, codigosSeleccionar) {
    console.log(1);
    $codigoProvincia = $('#sProvincia' + idSelect + ' option:selected').val();

    if ($codigoProvincia != '0') {


        limpiarSelectCanton(idSelect);
        $('#sCanton' + idSelect).attr('onchange', 'obtenerDistritos("' + idSelect + '"' + ')');

        $cantonesTemporal = [];
        $cantonesTemporal = $provincias[$codigoProvincia - 1].cantones;

        for (var i = 0; i < $cantonesTemporal.length; i++) {
            $('#sCanton' + idSelect).append(
                '<option value="' + $cantonesTemporal[i].codigo + '" >' + $cantonesTemporal[i].nombre + ' </option>'
            );
        }


        $('#sDistrito' + idSelect).html('');

        $('#sDistrito' + idSelect).append(
            '<option value="0">Distrito</option>'
        );
        $('#sDistrito' + idSelect + ' option[value="0"]').attr("selected", "selected");
        $('#sDistrito' + idSelect + '-button').find('span').text('Distrito');

        if (typeof codigosSeleccionar != 'undefined') {

            $('#sCanton' + idSelect + ' option[value="' + codigosSeleccionar[1] + '"]').attr("selected", "selected");
            $('#sCanton' + idSelect + '-button').find('span').text($('#sCanton' + idSelect + ' option:selected').text());
            obtenerDistritos(idSelect, codigosSeleccionar);

        }


    } else {

        limpiarSelectCanton(idSelect);
        limpiarSelectDistrito(idSelect);

    }

}

function obtenerDistritos(idSelect, codigosSeleccionar) {

    $codigoProvincia = $('#sProvincia' + idSelect + ' option:selected').val();
    $codigoCanton = $('#sCanton' + idSelect + ' option:selected').val();

    if ($codigoCanton != '0') {

        limpiarSelectDistrito(idSelect);
        $distritosTemporal = [];
        $distritosTemporal = $provincias[$codigoProvincia - 1].cantones[$codigoCanton - 1].distritos;

        for (var i = 0; i < $distritosTemporal.length; i++) {

            $('#sDistrito' + idSelect).append(
                '<option value="' + $distritosTemporal[i].codigo + '" >' + $distritosTemporal[i].nombre + ' </option>'
            );

        }

        if (typeof codigosSeleccionar != 'undefined') {

            $('#sDistrito' + idSelect + ' option[value="' + codigosSeleccionar[2] + '"]').attr("selected", "selected");
            $('#sDistrito' + idSelect + '-button').find('span').text($('#sDistrito' + idSelect + ' option:selected').text());

        }

    } else {

        limpiarSelectDistrito(idSelect);

    }
}

function limpiarSelectDistrito(idSelect) {

    $('#sDistrito' + idSelect).html('');
    $('#sDistrito' + idSelect).append(
        '<option value="0">Distrito</option>'
    );
    $('#sDistrito' + idSelect + ' option[value="0"]').attr("selected", "selected");
    $('#sDistrito' + idSelect + '-button').find('span').text('Distrito');

}

function limpiarSelectCanton(idSelect) {

    $('#sCanton' + idSelect).html('');
    $('#sCanton' + idSelect).append(
        '<option value="0">Cantón</option>'
    );
    $('#sCanton' + idSelect + ' option[value="0"]').attr("selected", "selected");
    $('#sCanton' + idSelect + '-button').find('span').text('Cantón');


}

function obtenerPrioridad(prioridad) {

    return prioridad == 1 ? 'Alta' : prioridad == 2 ? 'Media' : 'Baja';

}
