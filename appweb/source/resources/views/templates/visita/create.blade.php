<article id="selectedexpediente" class="col-md-10 col-md-offset-1 ng-scope" style="display:
 @{{ ver == 'asignar' ? 'block' : 'none' }}" >
	<header>
        <h3>
             Asignar expedientes
            <button class="btn btn-sm btn-delete btn-outline" ng-click='mostrar()'>
                <span class="glyphicon glyphicon-arrow-left"></span>
                Ver expedientes asignados
            </button>
            <div class="input-group" style="width: 722px; margin-top: 10px; margin-bottom: 10px">
        	    <input class="form-control" type="text" placeholder="Buscar expediente" ng-model="search_expediente""/>
            	<span class="input-group-addon">
                	<span class="glyphicon glyphicon-search text-muted"></span>
            	</span>
        	</div>
        </h3>
    </header>
	<!-- COLUMNAS VISIBLES -->
	<nav class="navbar navbar-default navbar-sm col-md-7" role="navigation">
				<div class="navbar-form" style="padding-top:4px">
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.cedulaAsignar">Cédula</label>
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.nombreAsignar">Nombre</label>
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.apellidosAsignar">Apellidos</label>
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.ubicacionAsignar">Ubicación</label>
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.estadoAsignar">Estado</label>
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.prioridadAsignar">Prioridad</label>
			<label class="checkbox-inline"><input type="checkbox" ng-model="columns.fecha_creacionAsignar">Fecha de creación</label>
		</div>
	</nav>

	<!-- TABLA DE CASOS -->
	<div class="table-responsive col-md-12" style="overflow-y: auto; max-height: 70vh">

		<table id="expedientesindex" class="table table-hover table-striped">
			<thead>
				<tr>
					<th ng-show="columns.cedulaAsignar">Cédula</th>
					<th ng-show="columns.nombreAsignar">Nombre</th>
					<th ng-show="columns.apellidosAsignar">Apellidos</th>
					<th ng-show="columns.ubicacionAsignar">Ubicación</th>
					<th ng-show="columns.estadoAsignar">Estado</th>
					<th ng-show="columns.prioridadAsignar">Prioridad</th>
					<th ng-show="columns.fecha_creacionAsignar">Fecha de creación</th>
					<th ng-show="columns.agregarAsignar">Opción</th>
				</tr>
			</thead>
			<tbody>
				<tr ng-repeat="e in expedientes | filter: search_expediente">
					<td ng-show="columns.cedulaAsignar">@{{ e.persona.cedula }}</td>
					<td ng-show="columns.nombreAsignar">@{{ e.persona.nombre }}</td>
					<td ng-show="columns.apellidosAsignar">@{{ e.persona.apellidos }}</td>
					<td ng-show="columns.ubicacionAsignar" region-text path="e.persona.ubicacion"></td>        
					<td ng-show="columns.estadoAsignar">
						<span class="label" ng-class="{'label-info': e.estado === 0, 'label-success': e.estado === 1, 'label-danger': e.estado === 2, 'label-warning': e.estado === 3}">
							@{{
								e.estado === 0 ? 'En valoración' :
								e.estado === 1 ? 'Aprobado' :
								e.estado === 2 ? 'No aprobado' :
								e.estado === 3 ? 'Pendiente' : ''
							}}
						</span>
					</td>
					<td ng-show="columns.prioridadAsignar">
						<span class="label" ng-class="{'label-success': e.prioridad === 1, 'label-warning': e.prioridad === 2, 'label-danger': e.prioridad === 3}">@{{ e.prioridad === 1 ? 'Baja' : e.prioridad === 2 ? 'Media' : e.prioridad === 3 ? 'Alta' : '' }}</span>
					</td>
					<td ng-show="columns.fecha_creacionAsignar">@{{ e.fecha_creacion }}</td>
					<td ng-show="columns.agregarAsignar">
						<button type="button" class="btn btn-success" ng-click="asignar(e, $indexExpediente)" >Asignar</button>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
	<div class="text-center col-md-12">
		<ul uib-pagination total-items="totalExpediente" class="pagination-sm" ng-model="pageExpediente" items-per-page="16" ng-change="indexExpediente(pageExpediente)"></ul>
	</div>
</article>