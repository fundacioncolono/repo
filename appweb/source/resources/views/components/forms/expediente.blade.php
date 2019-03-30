
{{-- DESCRIPCION --}}
<div class="form-group">
	<label class="col-sm-2" for="descripcion">Descripcion:</label>
	<div class="col-sm-12">
		<textarea name="descripcion" class="noresize form-control" rows="5" cols="50" placeholder="Anote en detalle la descripción del caso" {{  isset($descripcion_options) ? $descripcion_options : ''  }} required letras-numeros></textarea>

		<span  ng-show="account.descripcion.$error.required && account.descripcion.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>

         <span  ng-show="!account.descripcion.$error.required && account.descripcion.$error.letrasNumeros && account.descripcion.$touched" class="help-block" style="color: #E00808;"><strong>Sólo letras, números y signos (puntos, comas y espacios)</strong></span>
	</div>
</div>

{{-- REFERENTE --}}
{{-- Quizá se pueda pasar a una directiva para simplificar la implementacion del componente --}}
<div class="form-group col-sm-pull-2">
	<label class="text-right col-sm-4" for="referente">Referente:</label>
	<div class="col-sm-8">
		<label style="font-weight:100">
			Otro referente:
			<input type="checkbox" ng-model="{{ $hasReferenteOtro_model }}" ng-init="{{ $hasReferenteOtro_init_expression }}">
			<input type="hidden" name="hasReferenteOtro" ng-value="{{ $hasReferenteOtro_value }}">
		</label>
		<ng-show ng-show="{{ $hasReferenteOtro_model }}">
			<input class="form-control" type="text" name="referente_otro" placeholder="Nombre del referente" ng-model="{{ $referente_otro_model }}">
			@if(isset($newReferente_model) && isset($newReferente_value) && isset($newReferente_init_expression))
				<label style="font-weight:100;font-size:12px;">
					Agregar a opciones:
					<input type="checkbox" ng-model="{{ $newReferente_model }}" ng-init="{{ $newReferente_init_expression }}">
					<input type="hidden" name="newReferente" ng-value="{{ $newReferente_value }}">
				</label>
			@endif
			<p class="text-muted"><small>Deje en blanco si el caso no tiene referentes.</small></p>
		</ng-show>

		<input type="text" name="referente" placeholder="-Seleccione un referente-" class="form-control"
			autocomplete="off" ng-model="{{ $referente_model }}" ng-hide="{{ $hasReferenteOtro_model }}" typeahead-append-to-body="true"
			uib-typeahead="r.id as r.descripcion for r in {{ $referentes_list }} | filter:$viewValue | limitTo:{{ $referentes_limit }}"
			typeahead-show-hint="true" typeahead-min-length="0" typeahead-input-formatter="formatter($model, {{ $referentes_list }}, 'id', 'descripcion')" {{ isset($referente_typeahead_options) ? $referente_typeahead_options : '' }}>
		<input type="hidden" name="referente" ng-value="{{ $hasReferenteOtro_model }}? 1 : {{ $referente_model }}">
	</div>
</div>

{{-- PRIORIDAD --}}
<div class="form-group col-sm-pull-2">
	<label class="text-right col-sm-4" for="prioridad">Prioridad:</label>
	<div class="col-sm-8">
		<select class="form-control" name="prioridad" {{ isset($prioridad_options) ? $prioridad_options : '' }} convert-to-number required>
			<option value="" disabled selected>-Seleccionar prioridad-</option>
		</select>

		<span  ng-show="account.prioridad.$error.required && account.prioridad.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>
	</div>
</div>

{{-- ESTADO --}}
<div class="form-group col-sm-pull-2">
	<label class="text-right col-sm-4" for="estado" required>Estado de aprobación:</label>
	<div class="col-sm-8">
		<select class="form-control" name="estado" {{ isset($estado_options) ? $estado_options : '' }} convert-to-number required></select>
		
		<span  ng-show="account.estado.$error.required && account.estado.$touched" class="help-block" style="color: #E00808;"><strong>Este campo es requerido</strong></span>
	</div>
</div>

{{-- FECHAS DE ENTREGA Y PERÍODO DE APROBACIÓN --}}
<ng-if ng-if="{{ $approval_on }}">
	<h4 class="page-header">Fechas de entrega y período de aprobación</h4>
	
	{{-- FECHAS EN QUE RECIBE AYUDA --}}
	<div class="form-group col-lg-push-0 col-sm-12 col-sm-push-1">
		<h5 style="font-weight: bold">Fechas de entrega:</h5>
		
		<div class="form-group col-md-12 col-sm-6 col-xs-12 nogutters">
			<label class="text-muted text-nowrap control-label col-lg-4 col-md-5 col-sm-4 col-xs-6" style="font-weight: 100; text-align: left">Primera fecha:</label>
			<div class="col-lg-4 col-md-5 col-sm-4 col-xs-6">
				<input type="number" name="entrega_inicio" class="form-control" min="1" max="30" {{ isset($entrega_inicio_options) ? $entrega_inicio_options : '' }}>
			</div>
		</div>
		
		<div class="form-group col-lg-12 col-md-pull-0 col-md-12 col-sm-6 col-sm-pull-1 col-xs-12 nogutters">
			<label class="text-muted text-nowrap control-label col-lg-4 col-md-5 col-sm-4 col-xs-6" style="font-weight: 100; text-align: left">Segunda fecha:</label>
			<div class="col-lg-4 col-md-5 col-sm-4 col-xs-6">
				<input type="number" name="entrega_final" class="form-control" min="1" max="30" {{ isset($entrega_final_options) ? $entrega_final_options : '' }}>
			</div>
		</div>
	</div>
	
	{{-- PERIODO DE APROBACION --}}
	<div class="form-group col-lg-push-0 col-sm-12 col-sm-push-1">
		<h5 style="font-weight: bold">Período de aprobación</h5>

		<div class="form-group col-sm-6 col-xs-12 nogutters">
			<label class="control-label text-muted col-lg-6 col-md-12 col-sm-2 col-xs-3" style="font-weight: 100; text-align: left">Desde: </label>
			<div class="col-lg-10 col-md-12 col-sm-5 col-xs-6">
				<input class="form-control" type="text" name="fecha_desde" uib-datepicker-popup="dd-MM-yyyy" {{ isset($fecha_desde_options) ? $fecha_desde_options : ''}}>
			</div>
		</div>

		<div class="form-group col-md-pull-0 col-sm-6 col-sm-pull-2 col-xs-12 nogutters">
			<label class="control-label text-muted col-lg-6 col-md-12 col-sm-2 col-xs-3" style="font-weight: 100; text-align: left">Hasta: </label>
			<div class="col-lg-10 col-md-12 col-sm-5 col-xs-6">
				<input class="form-control" type="text" name="fecha_hasta" uib-datepicker-popup="dd-MM-yyyy" {{ isset($fecha_hasta_options) ? $fecha_hasta_options : ''}}>
			</div>
		</div>
	</div>
</ng-if>

{{ $slot }}