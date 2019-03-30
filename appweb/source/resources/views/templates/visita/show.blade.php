<article id="selectedexpediente" class="col-md-10 col-md-offset-1 ng-scope" style="display:
 @{{ ver == 'mostrar' ? 'block' : 'none' }}" >
    <div>
        <header>
            <h3>
                Expedientes Asignados
                <button class="btn btn-sm btn-show btn-outline" ng-click='mostrar()'>
                    <span class="glyphicon glyphicon-plus"></span>
                    Asignar expediente
                </button>
            </h3>
            <div class="alert alert-info" ng-show="selected.visitas.length == 0">
                <strong>No hay expedientes asignados a este inspector</strong>
            </div>
        </header>

        <!-- TABLA DE visitas -->
        <div class="table-responsive col-md-12" style='overflow-x: hidden;overflow-y: auto;' ng-show="selected.visitas.length != 0">
            <table id="visitasIndex" class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th ng-show="columns.cedulaVisita">Cédula</th>
                        <th ng-show="columns.nombreVisita">Nombre</th>
                        <th ng-show="columns.apellidosVisita">Apellidos</th>
                        <th ng-show="columns.ubicacionVisita">Ubicación</th>
                        <th ng-show="columns.observacionesVisita">Observaciones</th>
                        <th ng-show="columns.fecha_visitaVisita">Fecha de la visita</th>
                        <th ng-show="columns.fecha_asignadoVisita">Fecha asginado</th>                        
                        <th ng-show="columns.removerVisita">Opción</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-class="{'active' : v.isSelected}" ng-repeat="visita in selected.visitas">
                        <td ng-show="columns.cedulaVisita">@{{ visita.expediente.persona.cedula }}</td>
                        <td ng-show="columns.nombreVisita">@{{ visita.expediente.persona.nombre }}</td>
                        <td ng-show="columns.apellidosVisita">@{{ visita.expediente.persona.apellidos }}</td>
                        <td ng-show="columns.ubicacionVisita" region-text path="visita.expediente.persona.ubicacion"></td>
                        <td ng-show="columns.observacionesVisita">@{{ visita.observaciones }}</td>
                        <td ng-show="columns.fecha_visitaVisita">@{{ visita.fecha_visita }}</td>
                        <td ng-show="columns.fecha_asignadoVisita">@{{ visita.fecha_asignado }}</td>
                        <td ng-show="columns.removerVisita">
                            <button type="button" class="btn btn-danger" ng-click="alertDelete(visita)">Remover</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</article>