<!-- Correo  -->
<div class="form-group">
    <label class="control-label col-md-3" for="email">Correo:</label>
    <div class="col-md-8 col-md-push-1">
        <input type="text" class="form-control" name="email" placeholder="Ingrese el correo" ng-model="{{ $email_model }}" ng-value="{{ $email_value }}" required />
    </div>
</div>
<!-- Usuario  -->
<div class="form-group">
    <label class="control-label col-md-3" for="username">Usuario:</label>
    <div class="col-md-8 col-md-push-1">
        <input type="text" class="form-control" name="username" placeholder="Ingrese el nombre de usuario" ng-model="{{ $username_model }}" ng-value="{{ $username_value }}" required />
    </div>
</div>

<!-- Contraseña  -->
<div class="form-group">
    <label class="control-label col-md-3" for="password">Contraseña:</label>
    <div class="col-md-8 col-md-push-1">
        <input type="text" class="form-control" name="password" placeholder="Ingrese la contraseña" ng-model="{{ $password_model }}" ng-value="{{ $password_value }}" required />
    </div>
</div>
