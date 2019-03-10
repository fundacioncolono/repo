<article id="selectedayuda" class="col-md-10 col-md-offset-1" ng-controller="Ayudas_EditController">

	{{-- ADD AYUDAS MODAL (ANGULARJS DIRECTIVE) --}}
	<div id="addAyudasModal" class="modal fade" tabindex="-1" role="dialog" ng-init="modalinit()">
		<div class="modal-dialog" role="document">
			<add-ayudas-modal items="ayudas" repository="update.ayudas.attachs" label="descripcion" value="id"></add-ayudas-modal>
		</div>
	</div>

	<header>
		<h3>
			Ayudas solicitadas
			<small class="text-nowrap">Monto total asignado: @{{ selected.montoTotal | currency:"‎₡" }}</small>
			<ng-show ng-show="!selected.archivado">
				<button class="btn btn-sm btn-show btn-outline" title="Agregar ayudas" data-toggle="modal" data-target="#addAyudasModal">
					<span class="glyphicon glyphicon-plus"></span> <span class="hidden-xs">Agregar ayuda</span>
				</button>
				<button class="btn btn-sm btn-outline btn-update" ng-show="update.ayudas.attachs.length > 0 || update.ayudas.detachs.length > 0 || update.ayudas.updates.length > 0" ng-click="updateAyudas()">
					Guardar cambios
				</button>
				<button class="btn btn-sm btn-outline btn-none" ng-show="update.ayudas.attachs.length > 0 || update.ayudas.detachs.length > 0 || update.ayudas.updates.length > 0" ng-click="resetAyudas()">
					Cancelar
				</button>
			</ng-show>
		</h3>
		<h4 ng-show="update.ayudas.attachs.length > 0" style="text-indent: 1em">Nuevas ayudas</h4>
		<hr>
	</header>

	{{-- INCLUDE EACH ASIGNED AYUDA DETAIL --}}
	{{-- Wrapped into div.row element and ngRepeat directive --}}
	@include('templates.ayuda.preview')
	
	{{-- INCLUDE EACH ASIGNED AYUDA DETAIL --}}
	{{-- Wrapped into div.row element and ngRepeat directive --}}
	@include('templates.ayuda.details')

</article>