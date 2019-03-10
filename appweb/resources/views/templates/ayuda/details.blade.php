<div class="row">
	<ng-repeat ng-repeat="ayuda in selected.ayudas">
		<div class="clearfix" ng-if="$index % 3 === 0 && ayudas.length > 3"></div>

		<section class="col-md-4">
			<div class="expediente-info" ng-if="ayuda.editable && !selected.archivado" ng-class="{'editing': ayuda.editable}">
				<div class="controls" ng-show="ayuda.editable">
					<button type="button" class="btn btn-outline btn-show" ng-click="commit(ayuda)">
						<span class="glyphicon glyphicon-ok"></span> Aceptar cambios</button>
					<button type="button" class="close" title="Cancelar edición" ng-click="cancel(ayuda)">&times;</button>
				</div>

				{{-- AYUDA FORM COMPONENT IMPLEMENTATION --}} 
				@component('components.forms.ayuda_expedientes') 
					@slot('descripcion', 'ayuda.descripcion')
					
					@slot('detalle_options') 
						ng-model="ayuda.update.pivot.detalle" 
						ng-value="ayuda.pivot.detalle" 
					@endslot 
					
					@slot('monto_options')
						ng-model="ayuda.update.pivot.monto" 
						ng-value="ayuda.pivot.monto" 
				@endslot @endcomponent
			</div>

			<div class="expediente-info" ng-hide="ayuda.editable" ng-class="{'cached': ayuda.removed || ayuda.changed, 'archived': selected.archivado, 'text-expanded': ayuda.pivot.text_expanded}">

				<div class="row change-state" ng-show="ayuda.removed || ayuda.changed">
					<strong>Marcado para @{{ ayuda.removed ? 'eliminar' : ayuda.changed ? 'actualizar' : '' }}</strong>
					<button class="btn btn-outline btn-show btn-sm" ng-click="revert(ayuda)">
						<span class="glyphicon glyphicon-repeat" style="transform: rotateY(180deg)"></span>
						<span class="hidden-xs">Revertir cambios</span>
					</button>
				</div>

				<div class="btn-group" ng-hide="ayuda.removed" ng-if="!selected.archivado">
					<button class="btn-edit btn btn-outline btn-sm" ng-click="edit(ayuda)">
						<span class="glyphicon-pencil glyphicon"></span>
						<span class="hidden-xs">Editar</span>
					</button>
					<button type="button" class="btn btn-sm btn-delete btn-outline" ng-hide="ayuda.changed" ng-click="removeAsigned(ayuda)">
						<span class="glyphicon glyphicon-minus"></span>
						<span class="hidden-xs">Quitar</span>
					</button>
				</div>

				<label>Tipo de ayuda:</label>
				<h5 class="lead">@{{ ayuda.descripcion }}</h5>
				<label>Monto:</label>
				<br>
				<p class="lead">@{{ ayuda.pivot.monto | currency:"‎₡" }}</p>
				<label>Descripcion:</label>
				<br>
				<p ng-class="{'text-collapsed': !ayuda.pivot.text_expanded}">
					<span ng-init="ayuda.pivot.detalle_tmp = ayuda.pivot.detalle.substring(0,350)">@{{ ayuda.pivot.detalle_tmp }}</span>
					<span ng-show="ayuda.pivot.detalle.length > 350 && ayuda.pivot.detalle_tmp.length <= 350" class="text-length-toggle">
						...
						<br>
						<a class="text-nowrap" href="#" ng-click="ayuda.pivot.detalle_tmp = ayuda.pivot.detalle; ayuda.pivot.text_expanded = true">ver más &raquo;</a>
					</span>
					<span ng-show="ayuda.pivot.detalle_tmp.length > 350" style="max-height: 20px; min-height: 20px">
						<br>
						<a class="text-nowrap" href="#" ng-click="ayuda.pivot.detalle_tmp = ayuda.pivot.detalle.substring(0,350); ayuda.pivot.text_expanded = false">&laquo; ver menos</a>
					</span>
				</p>
			</div>
		</section>
	</ng-repeat>
</div>