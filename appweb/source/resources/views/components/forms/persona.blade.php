<!--<form name="personasForm" novalidate> -->
    <!-- CEDULA -->
    <div class="form-group">
        <label class="control-label col-md-3" for="cedula">Cédula:</label>
        <div class="col-md-8 col-md-push-1">
            <input type="text" class="form-control" name="cedula" placeholder="Formato: x0xxx0xxx"
            {{ isset( $cedula_options) ? $cedula_options : '' }} ng-readonly='@{{ selected.persona.editable }}' required cedula>
            {{ isset($cedula_help) ? $cedula_help : '' }}

            <span  ng-show="account.cedula.$error.required && account.cedula.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

            <span  ng-show="!account.cedula.$error.required && account.cedula.$error.cedula && account.cedula.$touched" class="help-block" style="color: #E00808;"><strong>Debe seguir el formato x0xxx0xxx, cambie las x por números</strong></span>
        </div>
    </div>

    <!-- NOMBRE -->
    <div class="form-group">
        <label class="control-label col-md-3" for="nombre">Nombre:</label>
        <div class="col-md-8 col-md-push-1">
            <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" {{ isset($nombre_options) ? $nombre_options : '' }} required letras>
            
            <span  ng-show="account.nombre.$error.required &&  account.nombre.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

            <span  ng-show="!account.nombre.$error.required && account.nombre.$error.letras && account.nombre.$touched" class="help-block" style="color: #E00808;"><strong>Sólo se permiten letras y espacios</strong></span>
        </div>
    </div>

    <!-- APELLIDOS -->
    <div class="form-group">
        <label class="control-label col-md-3" for="apellidos">Apellidos:</label>
        <div class="col-md-8 col-md-push-1">
            <input type="text" class="form-control" name="apellidos" placeholder="Ingrese los apellidos" {{ isset($apellidos_options) ? $apellidos_options : '' }} required letras>

            <span  ng-show="account.apellidos.$error.required && account.apellidos.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

            <span  ng-show="!account.apellidos.$error.required && account.apellidos.$error.letras && account.apellidos.$touched" class="help-block" style="color: #E00808;"><strong>Sólo se permiten letras y espacios</strong></span>
        </div>
    </div>

    <!-- TELEFONOS -->
    <div class="form-group">
        <label class="control-label col-md-3" for="telefonos">Teléfono(s):</label>
        <div class="col-md-8 col-md-push-1">
            <textarea name="telefonos" class="noresize form-control" rows="5" cols="50" placeholder="Separe por comas (,) o espacios" {{ isset($telefonos_options) ? $telefonos_options : '' }} telefonos></textarea>
            
            <span  ng-show="account.telefonos.$error.telefonos && account.telefonos.$touched" class="help-block" style="color: #E00808;"><strong>Debe seguir el formato, los telefonos deben separarse por (,)</strong></span>
        </div>
    </div>

    <!-- UBICACION -->
    <div class="form-group">
        <label class="control-label col-md-3" for="ubicacion">Ubicación:</label>
        <div class="col-md-8 col-md-offset-1">
            <region-select {{ isset($ubicacion_options) ? $ubicacion_options : '' }} name="distrito" required></region-select>

            <span  ng-show="account.distrito.$error.required && account.distrito.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>
        </div>
    </div>

    <!-- DIRECCION EXACTA -->
    <div class="form-group">
        <label class="control-label col-md-4" for="direccion">Dirección exacta:</label>
        <div class="col-md-8">
            <textarea name="direccion" class="noresize form-control" rows="5" cols="50"  {{ isset($direccion_options) ? $direccion_options : '' }} required letras-numeros></textarea>

            <span  ng-show="account.direccion.$error.required && account.direccion.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

            <span  ng-show="!account.direccion.$error.required && account.direccion.$error.letrasNumeros && account.direccion.$touched" class="help-block" style="color: #E00808;"><strong>Sólo letras, números y signos (puntos, comas y espacios)</strong></span>
        </div>

    </div>

    <!-- CONTACTOS -->
    <div class="form-group">
        <label class="control-label col-sm-3" for="contactos">Contacto(s):</label>
        <div class="col-md-8 col-md-push-1">
            <textarea name="contactos" class="noresize form-control" rows="5" cols="50" {{ isset($contactos_options) ? $contactos_options : '' }} letras-numeros></textarea>
            
            <span ng-show="account.contactos.$error.letrasNumeros && account.contactos.$touched" class="help-block" style="color: #E00808;"><strong>Sólo letras, números y signos (puntos, comas y espacios)</strong></span>
        </div>
    </div>

<!--</form>-->