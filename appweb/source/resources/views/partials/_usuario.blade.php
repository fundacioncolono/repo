<div class="form-group{{ $errors->has('username') ? ' has-error' : '' }} mt-1">
    <label for="name" class="col-md-5 control-label">Nombre de usuario:</label>

    <div class="col-md-7">
        <input id="name" type="text" class="form-control" name="username" ng-model="username" value="{{ old('username') }}" required usuario>

         <span  ng-show="account.username.$error.required && account.username.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

        <span  ng-show="!account.username.$error.required && account.username.$error.usuario && account.username.$touched" class="help-block" style="color: #E00808;"><strong>Nombre de usuario incorrecto</strong></span>
    </div>
</div>

<div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
    <label for="email" class="col-md-5 control-label">Correo electrónico:</label>

    <div class="col-md-7">
        <input id="email" type="text" class="form-control" name="email" ng-model="email" value="{{ old('email') }}" required correo> 
         
         <span  ng-show="account.email.$error.required && account.email.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

        <span  ng-show="!account.email.$error.required && account.email.$error.correo && account.email.$touched" class="help-block" style="color: #E00808;"><strong>Debe seguir el formato de correo</strong></span>
    </div>
</div>

<div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
    <label for="password" class="col-md-5 control-label">Contraseña</label>

    <div class="col-md-7">
        <input id="password" type="password" class="form-control" name="password" ng-model="password" required contrasena>

        <span  ng-show="account.password.$error.required && account.password.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

        <span  ng-show="!account.password.$error.required && account.password.$error.contrasena && account.password.$touched" class="help-block" style="color: #E00808;"><strong>Contraseña incorrecta</strong></span>
    </div>
</div>

<div class="form-group">
    <label for="password-confirm" class="col-md-5 control-label">Confirmar contraseña:</label>

    <div class="col-md-7">
        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" ng-model="password_confirmation" required contrasena nx-equal-ex="password">

        <span  ng-show="account.password_confirmation.$error.required && account.password_confirmation.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

        <span  ng-show="!account.password_confirmation.$error.required && account.password_confirmation.$error.contrasena && account.password_confirmation.$touched" class="help-block" style="color: #E00808;"><strong>Contraseña incorrecta</strong></span>

        <span  ng-show="!account.password_confirmation.$error.required && !account.password_confirmation.$error.contrasena && account.password_confirmation.$error.nxEqualEx && account.password_confirmation.$touched" class="help-block" style="color: #E00808;"><strong>La contraseña es diferente</strong></span>

    </div>
</div>
