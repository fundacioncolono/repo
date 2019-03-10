
<nav id="nav-top" class="navbar navbar-default navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">

            <!-- Collapsed Hamburger -->
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

            <!-- Branding Image -->
            <a class="navbar-brand" href="{{ url('/') }}" style="border-right:thin solid #e4e4e4">{{ config('app.name') }}</a>
        </div>

        <div class="collapse navbar-collapse" id="app-navbar-collapse">
            <!-- Left Side Of Navbar -->

            <ul class="nav navbar-nav">
                <li class="{{ \Request::is('expedientes*')? 'active' : '' }} dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Expedientes/Casos<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('expedientes.index') }}">Ver los expedientes</a></li>
                        <li><a href="{{ route('expedientes.create') }}">Crear un nuevo caso</a></li>
                    </ul>
                </li>
                <li class="{{ \Request::is('inspectores*')? 'active' : '' }} dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Inspectores<span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="{{ route('inspectores.index') }}">Ver los expedientes</a></li>
                        <li><a href="{{ route('inspectores.create') }}">Crear un nuevo caso</a></li>
                    </ul>
                </li>
                <li class="{{ \Request::is('ayudas*') || \Request::is('usuarios*') ? 'active' : '' }} dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Mantenimiento<span class="caret"></span></a>
                    <ul class="dropdown-menu multi-level" role="menu">
                        <li><a href="{{ route('verAyudas') }}">Ayudas</a></li>
                        <!-- <li class="dropdown-submenu">
                            <a>Ayudas</a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('verAyudas') }}">Ver los ayudas</a></li>
                                <li><a href="{{ route('ayudas.create') }}">Registrar un ayudas</a></li>       
                            </ul>
                        </li> -->
                        <li><a href="{{ route('verUsuarios') }}">Usuarios</a></li>
                    </ul>
                </li>
            </ul>
            
            <!-- Right Side Of Navbar -->
            <ul class="nav navbar-nav navbar-right">
                <!-- Authentication Links -->
                
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><span class="glyphicon glyphicon-bell"></span></a>
                    <ul class="notification dropdown-menu" role="menu">
                        <li class="dropdown-header">(Sin implementar aún)</li>
						<li class="notification-item">
							<div class="notification-header bg-danger text-danger">Aviso - <b>05/02/2018</b> 10:15 PM</div>
							<div class="notification-body">
								<p>Expiró el tiempo máximo de visita para el expediente asignado a
									<b>varo123 (Álvaro González Q.)</b>
								</p>
								<div class="text-right">
									<button class="btn btn-sm btn-outline btn-edit">Ver expediente</button>
								</div>
							</div>
						</li>
						<li class="notification-item">
							<div class="notification-header bg-success text-success">Observaciones - <b>05/02/2018</b> 11:25 PM</div>
							<div class="notification-body">
								<p><b>Álvaro González Quirós</b> ha hecho observaciones del caso asignado</p>
								<div class="text-right"><button class="btn btn-sm btn-outline btn-edit">Ver expediente</button></div>
							</div>
						</li>
                    </ul>
                </li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->username }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="#">Preferencias</a></li>
                        <li>
                            <a href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">Salir</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>
