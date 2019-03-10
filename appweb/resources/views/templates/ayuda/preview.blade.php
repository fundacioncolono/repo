<div class="row">
	<ng-repeat ng-repeat="ayuda in update.ayudas.attachs">
		<div class="clearfix" ng-if="$index % 3 === 0 && update.ayudas.attachs.length > 3"></div>
		<section class="col-md-4">
			<div class="expediente-info editing" style="padding: 1em">

				<div class="btn-group">
					<button type="button" class="btn btn-sm btn-delete btn-outline" ng-click="removeNew($index)">
						<span class="glyphicon glyphicon-minus"></span>
						<span class="hidden-xs">Quitar</span>
					</button>
				</div>

				{{-- AYUDA FORM COMPONENT IMPLEMENTATION --}} 
				@component('components.forms.ayuda_expedientes') 
					@slot('descripcion', 'ayuda.descripcion')

					@slot('monto_options', 'ng-model=ayuda.monto')
					@slot('detalle_options', 'ng-model=ayuda.detalle')
				@endcomponent
			</div>
		</section>
	</ng-repeat>
</div>
<ng-show ng-show="update.ayudas.attachs.length > 0 && selected.ayudas.length > 0">
	<h4 style="text-indent: 1em">Previamente asignado</h4>
	<hr>
</ng-show>
