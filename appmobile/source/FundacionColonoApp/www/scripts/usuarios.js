$(document).ready(function () {

    $('#tabDatosUsuario').addClass('ui-btn-active');
    obtenerProvincias('Perfil');
    llenarDatos();

});

function showHidePasswordPerfil() {

    var x = document.getElementById("txtContrasenaPerfil");
    if (x.type === "password") {
        x.type = "text";
    } else {
        x.type = "password";
    }

}


function cambiarTabDatosPersonales() {

    $('#contenedorDatosUsuario').css('display', 'none ');
    $('#contenedorDatosPersonales').css('display', 'block ');

}

function cambiarTabDatosUsuario() {

    $('#contenedorDatosUsuario').css('display', 'block ');
    $('#contenedorDatosPersonales').css('display', 'none');

}

function llenarDatos() {

    $ubicacion = $persona.ubicacion;
    $ubicacion = $ubicacion.split('/');
    
    $('#txtUsuarioPerfil').val( $usuario.username );
    $('#txtContrasenaPerfil').val( $usuario.password);
    $('#txtCorreoPerfil').val( $usuario.email);
    
    $('#txtCedulaPerfil').val( $persona.cedula );
    $('#txtNombrePerfil').val( $persona.nombre);
    $('#txtApellidosPerfil').val( $persona.apellidos );
    $('#txtTelefonoPerfil').val( $persona.telefonos );
    obtenerProvincias('Perfil', $ubicacion);
    $('#txtDireccionExactaPerfil').val($persona.direccion);
    $('#txtContactosPerfil').val( $persona.contactos );

}


function guardarDatosUsuario() {

    $username = $('#txtUsuarioPerfil').val();
    $password = $('#txtContrasenaPerfil').val();
    $email = $('#txtCorreoPerfil').val()

    event.preventDefault();

    if ($password != '' ) {
        if ($email != '') {

            $.ajax({
                url: $direccionServicios + 'usuariosMobile/update',
                type: 'GET',
                dataType: 'json',
                data: { username: $username, password: $password, email: $email },
                success: function (msg, status, jqXHR) {

                    if (msg.resultado) {
                        
                        $usuario.username = $username;
                        $usuario.password = $password;
                        $usuario.email = $email;
                        localStorage['usuario'] = JSON.stringify($usuario);

                        alert('Se ha actualizado correctamente');

                    } else {
                        alert('Error al actualizar datos');
                    }

                }
            });

        } else {
            alert('El correo es necesario');
        }  

    } else {
        alert('La contraseña es necesario');
    }

}

function guardarDatosPersonales() {

    $cedula = $('#txtCedulaPerfil').val();
    $nombre = $('#txtNombrePerfil').val();
    $apellidos = $('#txtApellidosPerfil').val();
    $telefonos = $('#txtTelefonoPerfil').val();
    $ubicacion = $('#sProvinciaPerfil option:selected').val() + '/' + $('#sCantonPerfil option:selected').val() + '/' + $('#sDistritoPerfil option:selected').val();
    $direccion = $('#txtDireccionExactaPerfil').val();
    $contactos = $('#txtContactosPerfil').val();

    event.preventDefault();

    $.ajax({
        url: $direccionServicios + 'personasMobile/update',
        type: 'GET',
        dataType: 'json',
        data: {
            cedula: $cedula, nombre: $nombre, apellidos: $apellidos, telefonos: $telefonos,
            ubicacion: $ubicacion, direccion: $direccion, contactos: $contactos
        },
        success: function (msg, status, jqXHR) {

            if (msg.resultado) {

                $persona.cedula = $cedula;
                $persona.nombre = $nombre;
                $persona.apellidos = $apellidos;
                $persona.telefonos = $telefonos;
                $persona.ubicacion = $ubicacion;
                $persona.direccion = $direccion;
                $persona.contactos = $contactos;
                localStorage['persona'] = JSON.stringify($persona);

                alert('Se ha actualizado correctamente');

            } else {
                alert('Error al actualizar datos');
            }

        }
    });
        
}
