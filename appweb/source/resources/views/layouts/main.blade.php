<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <!-- Scripts top -->
    <script src="{{ asset('js/angularjs/angular.1.6.4.min.js') }}"></script>
    <script src="{{ asset('js/angularjs/angular-animate.1.6.4.min.js') }}"></script>
    <script src="{{ asset('js/angularjs/angular-resource.1.6.4.js') }}"></script>
    <script src="{{ asset('js/ui-bootstrap-tpls-2.5.0.min.js') }}"></script>
    <script src="{{ asset('app/app.js') }}"></script>
    <script src="{{ asset('app/providers.js') }}"></script>
    <script src="{{ asset('app/services.js') }}"></script>
    <script src="{{ asset('app/factory.js') }}"></script>
    <script src="{{ asset('app/directives.js') }}"></script>
    <script src="{{ asset('app/validation.js') }}"></script>
    @stack('scripts_top')
    
    <title>{{ config('app.name') }}</title>
</head>
<body>
    
    @include('partials._navbar')
    
    <main class="container-fluid" style="padding-top:50px" ng-app="App" ng-cloak>
        <div class="row" style="padding-bottom: 1em">
            @yield('content')
        </div>
    </main>
    
    
    <!-- Scripts Bottom -->
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    @stack('scripts_bottom')
</body>
</html>
