<!-- CEDULA -->
<div class="form-group">
    <label class="control-label col-md-3" for="cedula">Cédula:</label>
    <div class="col-md-8 col-md-push-1">
        <input type="text" class="form-control" name="cedula" placeholder="Formato: x0xxx0xxx" 
        {{ isset($cedula_options) ? $cedula_options : '' }} ng-readonly='@{{ selected.persona.editable}}' required>
        {{ isset($cedula_help) ? $cedula_help : '' }}
    </div>
</div>

<!-- NOMBRE -->
<div class="form-group">
    <label class="control-label col-md-3" for="nombre">Nombre:</label>
    <div class="col-md-8 col-md-push-1">
        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre" {{ isset($nombre_options) ? $nombre_options : '' }} required>
    </div>
</div>

<!-- APELLIDOS -->
<div class="form-group">
    <label class="control-label col-md-3" for="apellidos">Apellidos:</label>
    <div class="col-md-8 col-md-push-1">
        <input type="text" class="form-control" name="apellidos" placeholder="Ingrese los apellidos" {{ isset($apellidos_options) ? $apellidos_options : '' }} required>
    </div>
</div>

<!-- TELEFONOS -->
<div class="form-group">
    <label class="control-label col-md-3" for="telefonos">Teléfono(s):</label>
    <div class="col-md-8 col-md-push-1">
        <textarea name="telefonos" class="noresize form-control" rows="5" cols="50" placeholder="Separe por comas (,) o espacios" {{ isset($telefonos_options) ? $telefonos_options : '' }} ></textarea>
    </div>
</div>

<!-- UBICACION -->
<div class="form-group">
    <label class="control-label col-md-3" for="ubicacion">Ubicación:</label>
    <div class="col-md-8 col-md-offset-1">
        <region-select {{ isset($ubicacion_options) ? $ubicacion_options : '' }}></region-select>
    </div>
</div>

<!-- DIRECCION EXACTA -->
<div class="form-group">
    <label class="control-label col-md-4" for="direccion">Dirección exacta:</label>
    <div class="col-md-8">
        <textarea name="direccion" class="noresize form-control" rows="5" cols="50" {{ isset($direccion_options) ? $direccion_options : '' }} required></textarea>
    </div>
</div>

<!-- CONTACTOS -->
<div class="form-group">
    <label class="control-label col-sm-3" for="contactos">Contacto(s):</label>
    <div class="col-md-8 col-md-push-1">
        <textarea name="contactos" class="noresize form-control" rows="5" cols="50" {{ isset($contactos_options) ? $contactos_options : '' }}></textarea>
    </div>
</div>
