<nav class="navbar navbar-default" role="navigation" style="margin-top: 20px; margin-left: 10px; width: 1100px;">
    <form class="navbar-form">
        <!-- busqueda -->
        <div class="input-group">
            <input  style="width: 500px;" class="form-control" type="text" placeholder="Buscar" ng-model="search"/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-search text-muted"></span>
            </span>
        </div>
        <!-- filtrar -->
        <button class="btn-outline btn btn-none" ng-init="filter_active = false" ng-click="filter_active = !filter_active; filter_init()" style="margin: 0 4px" type="button" data-toggle="collapse" data-target="#filter">
            Filtrar
            <span class="caret" ng-class="{'caret-right': !filter_active}"></span>
        </button>
        <button class="btn-outline btn btn-edit" type="button" ng-show="filter_data.filtered" ng-click="filter_data.filtered = false; search = ''; index();">Ver todos</button>

        <!-- LINK AGREGAR NUEVO USUARIO INSPECTOR -->
        <a class="btn btn-primary btn-sm" href="{{ route('inspectores.create') }}" style="float: right">Agregar nuevo inspector</a>
    </form>
</nav>
