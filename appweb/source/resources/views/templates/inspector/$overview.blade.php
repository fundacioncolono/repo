@component('components.animatedModal')

   @slot('id', 'show_modal')

   @slot('ngController', 'Inspectores_EditController')

   @slot('header_content')
       <div class="col-xs-2 col-md-1 controls">
           <button type="button" class="close pull-left close-animatedModal" title="Cerrar">&times;</button>
       </div>
       <div class="col-xs-10 text-left">
		      <button type="button" class="btn btn-sm btn-outline @{{ selected.activo == 1 ? 'btn-delete' : 'btn-show'}}"ng-click="delete()">
               <span class="glyphicon"  ng-class="{'glyphicon-refresh': !selected.activo, 'glyphicon-ban-circle': selected.activo}"></span>
               <span class="hidden-xs"> @{{ selected.activo == 1 ? 'Deshabilitar' : 'Habilitar'}} inspector</span>
           </button>
       </div>
   @endslot

  {{-- @slot('content_classes', 'expediente-content') --}}

  <!-- DATOS DE LA PERSONA -->
  <div style="display: @{{ ver == 'mostrar' ? 'block' : 'none' }}" >
    @include('templates.persona.show')
  </div>
  <!-- INFORMACION DE LOS EXPEDIENTES ASIGNADOS -->
  @include('templates.visita.show')

  <!-- ASIGNAR EXPEDIENTES -->
  @include('templates.visita.create')

@endcomponent
