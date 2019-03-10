 @component('components.animatedModal')
 
    @slot('id', 'show_modal')

    @slot('ngController', 'Expedientes_OverviewController')
    
    @slot('header_content')
        <div class="col-xs-2 col-md-1 controls">
            <button type="button" class="close pull-left close-animatedModal" title="Cerrar">&times;</button>
        </div>
        <div class="col-xs-10 text-left">
            <button type="button" class="btn btn-delete btn-sm btn-outline" title="Archivar" ng-hide="selected.archivado" ng-click="delete()">
                <span class="glyphicon glyphicon-briefcase"></span>
                <span class="hidden-xs">Archivar</span>
            </button>
            <button type="button" class="btn btn-show btn-sm btn-outline" title="Restaurar" ng-show="selected.archivado" ng-click="restore()">
                <span class="glyphicon glyphicon-refresh"></span>
                <span class="hidden-xs">Restaurar</span>
            </button>
            <a href="personas/@{{ selected.persona.cedula }}/historico" target="_blank" class="btn btn-outline btn-sm btn-edit" title="Historial de cambios">
                <span class="glyphicon glyphicon-time"></span>
                <span class="hidden-xs">Historial de cambios</span>
            </a>
            <span style="border-left: thin solid #ccc; padding: 0 4px" ng-show="update.cache || (update.cache && (update.ayudas.attachs.length > 0 || update.ayudas.detachs.length > 0 || update.ayudas.updates.length > 0))">
                <button type="button" class="btn btn-outline btn-update" title="Guardar cambios" ng-click="updateCaso()">
                    <span class="glyphicon glyphicon-edit"></span>
                    <span class="hidden-xs">Guardar todo</span>
                </button>
            </span>
        </div>
    @endslot
        
    @slot('content_classes', 'expediente-content')
    
    <!-- DATOS DE LA PERSONA -->
    @include('templates.persona.show')
    
    <!-- INFORMACION DEL EXPEDIENTE -->
    @include('templates.expediente.show')
    
    <!-- INFORMACION DE LAS AYUDAS -->
	@include('templates.ayuda.show')
        
@endcomponent