@component('components.forms.expediente')

	@slot('descripcion_options')
		ng-model="update.caso.descripcion"
		ng-value="selected.descripcion"
	@endslot

{{-- ------------------------- REFERENTE CONFIG ------------------------- --}}
{{-- -------------------------------------------------------------------- --}}
	@slot('hasReferenteOtro_model', 'update.caso.hasReferenteOtro')
	@slot('hasReferenteOtro_init_expression', "update.caso.hasReferenteOtro = !!update.caso.referente_otro || !update.caso.referente_otro && update.caso.referente.id === $first_referente")
	@slot('hasReferenteOtro_value', 'update.caso.hasReferenteOtro')

	@slot('referente_otro_model', 'update.caso.referente_otro')

	@slot('referente_model', 'update.caso.referente_selected')
	@slot('referentes_list', 'referentes')
	@slot('referentes_limit', '-20')
{{-- -------------------------------------------------------------------- --}}
{{-- -------------------------------------------------------------------- --}}

	@slot('prioridad_options')
        ng-model="update.caso.prioridad_selected"
        ng-options="p.name for p in prioridades track by p.id"
	@endslot
	
	@slot('estado_options')
        ng-model="update.caso.estado_selected"
        ng-options="e.name for e in estados track by e.id"
    @endslot

	@slot('approval_on', 'update.caso.estado_selected.id === 1')

	@slot('entrega_inicio_options')
		ng-model="update.caso.entrega_inicio"
		ng-value="selected.entrega_inicio"
	@endslot
	
	@slot('entrega_final_options')
		ng-model="update.caso.entrega_final"
		ng-value="selected.entrega_final"
	@endslot

    @slot('fecha_desde_options')
        ng-model="update.caso.datePickers.from.date"
        ng-click="update.caso.datePickers.from.open = true"
        is-open="update.caso.datePickers.from.open"
        datepicker-options="update.caso.datePickerOptions.from"
        ng-required="update.caso.estado_selected.id === 1"
    @endslot
    
    @slot('fecha_hasta_options')
        ng-model="update.caso.datePickers.to.date"
        ng-click="update.caso.datePickers.to.open = true"
        is-open="update.caso.datePickers.to.open"
        datepicker-options="update.caso.datePickerOptions.to"
        ng-required="update.caso.estado_selected.id === 1"
    @endslot

@endcomponent