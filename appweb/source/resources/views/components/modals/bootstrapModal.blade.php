<div id="{{ !isset($id) ?: $id }}" class="modal fade" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content" {{ !isset($modal_options) ?: $modal_options }}>

			<div class="modal-header">
				<button type="button" class="close" title="Cerrar" data-dismiss="modal" aria-label="Cerrar"><span aria-hidden="true">&times;</span></button>
				{{ !isset($header) ?: $header }}
			</div>

			<div class="modal-body row">
				{{ $slot }}
			</div>

			<div class="modal-footer">
				{{ !isset($footer) ?: $footer }}
			</div>

		</div>
	</div>
</div>
