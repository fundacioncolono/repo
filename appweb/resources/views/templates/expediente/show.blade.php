<article id="selectedexpediente" class="col-md-4 col-md-offset-1" ng-class="{'editing': selected.editable}" ng-controller="Expedientes_EditController">
    <header>
        <h3>
            Detalles del caso
            <button class="btn btn-sm btn-outline btn-update" title="Pendiente de entrega"><span class="glyphicon glyphicon-alert"></span> <span class="hidden-xs">Pendiente de entrega</span></button>
            <small>@{{ (selected.editable)? '(en edición)' : '' }}</small>
        </h3>
        <hr>
    </header>

    <section class="expediente-info form-horizontal" style="overflow-y: auto" ng-if="selected.editable">
        <div class="controls" ng-show="selected.editable">
            <button type="button" class="btn btn-outline btn-show" ng-click="commit()">
                <span class="glyphicon glyphicon-ok"></span> Aceptar cambios</button>
            <button type="button" class="close" title="Cancelar edición" ng-click="selected.editable = false">&times;</button>
        </div>

        {{-- INCLUDE EXPEDIENTE FORM COMPONENT --}}
        @include('templates.expediente.$edit')
    </section>

    <section class="expediente-info" ng-class="{'cached': update.cache, 'archived': selected.archivado}" ng-hide="selected.editable">

        <div class="row change-state" ng-show="update.cache">
            <strong>Marcado para actualizar</strong>
            <button class="btn btn-outline btn-show btn-sm" ng-click="revert()">
                <span class="glyphicon glyphicon-repeat" style="transform: rotateY(180deg)"></span> 
                <span class="hidden-xs">Revertir cambios</span>
            </button>
        </div>

        <button type="button" class="btn-outline btn btn-edit btn-sm" ng-click="edit()" ng-if="!selected.archivado">
            <span class="glyphicon glyphicon-pencil"></span> 
            <span class="hidden-xs">Editar</span>
        </button>

        <div class="expediente-info-item">
            <label>Descripción: </label>
            <p>@{{ selected.descripcion }}</p>
        </div>

        <div class="expediente-info-item">
            <label>Referente: </label>
            <span>@{{ selected.referente_otro !== null? selected.referente_otro : selected.referente.descripcion }}</span>
        </div>

        <div class="expediente-info-item">
            <label>Prioridad: </label>
            <span class="label" ng-class="{'label-info':selected.prioridad === 1, 'label-warning': selected.prioridad === 2, 'label-danger':selected.prioridad === 3}">
                @{{ (selected.prioridad === 1)? 'Baja' : (selected.prioridad === 2)? 'Media' : (selected.prioridad === 3)? 'Alta' : '' }}
            </span>
        </div>

        <div class="expediente-info-item">
            <label>Estado de aprobación: </label>
            <br class="visible-xs">
            <span class="label" ng-class="{'label-info':selected.estado === 0, 'label-success': selected.estado === 1, 'label-danger': selected.estado === 2, 'label-warning': selected.estado === 3}">
                @{{ selected.estado === 0 ? 'En valoración' : selected.estado === 1 ? 'Aprobado' : selected.estado === 2 ? 'No aprobado' : selected.estado === 3 ? 'Pendiente' : '' }}
            </span>
            <p class="help-block" ng-show="selected.estado !== 1">
                <small>Para mostrar los
                    <strong>meses asignados</strong>, el expediente debe estar
                    <u>Aprobado</u>.
                </small>
            </p>
        </div>

        <div class="expediente-info-item" ng-show="selected.estado === 1">
            <label>Aprobado</label>
            <p style="padding: 0 10px">
                Desde: @{{ selected.fecha_desde | date : 'dd-MM-yyyy'}}
                <br> Hasta: @{{ selected.fecha_hasta | date : 'dd-MM-yyyy'}}
                <br>
                <small class="help-block">Número de meses: @{{ update.cache? 'sin calcular' : selected.meses  }}</small>
            </p>
        </div>

        <div class="expediente-info-item" ng-show="selected.estado === 1">
            <label>Recibe entregas</label>
            <p style="padding: 0 10px">
                los @{{ selected.entrega_inicio }} y los @{{ selected.entrega_final }} de cada mes
            </p>
        </div>

    </section>

</article>