$(document).ready(function () {
});

function iniciarSesion() {

    $username = $('#txtUsuario').val();
    $password = $('#txtContrasena').val();
    $token = $('#token').val();

    if ($username != '') {
        if ($password != '') {
            
            $.ajax({
                url: $direccionServicios + 'usuariosMobile/comprobarSesion',
                headers: { 'X-CSRF-TOKEN': $token},
                type: 'GET',
                dataType: 'json',
                data: { username: $username, password: $password},
                success: function (msg, status, jqXHR) {

                    if (msg.resultado) {

                        $inspector = {};
                        $inspector.id = msg.inspector.id;
                        localStorage['inspector'] = JSON.stringify($inspector);

                        $usuario = {};
                        $usuario.username = msg.usuario.username;
                        $usuario.password = $password;
                        $usuario.email = msg.usuario.email;
                        localStorage['usuario'] = JSON.stringify($usuario);

                        $persona = msg.persona;
                        localStorage['persona'] = JSON.stringify($persona);

                        irInicio();

                    } else {
                        alert('Información incorrecta');
                    }

                }
            });
            
        } else {
            alert('Debe ingresar el contraseña');
        }
    } else {
        alert('Debe ingresar el usuario');
    }

}
