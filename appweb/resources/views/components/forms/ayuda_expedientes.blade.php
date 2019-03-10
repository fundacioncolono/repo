<div class="form-horizontal">
	<div class="form-group">
		<label class="col-md-6">Tipo de ayuda:</label>
		<h5 class="lead col-md-12" ng-bind="{{ $descripcion }}"></h5>
	</div>

	<div class="form-group">
		<label class="col-md-3">Detalle:</label>
		<div class="col-md-12">
			<textarea name="" class="form-control noresize" cols="50" rows="5" {{ !isset($detalle_options) ?: $detalle_options }}></textarea>
		</div>
	</div>

	<div class="form-group">
		<label class="control-label col-md-2 text-nowrap">Monto:</label>
		<div class="col-md-4">
			<input type="text" name="" class="form-control" {{ !isset($monto_options) ?: $monto_options }}>
		</div>
	</div>
</div>