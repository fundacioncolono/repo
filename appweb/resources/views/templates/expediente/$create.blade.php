
@component('components.forms.expediente')
	
{{-- ------------------------- REFERENTE CONFIG ------------------------- --}}
{{-- -------------------------------------------------------------------- --}}
    @slot('hasReferenteOtro_model', 'hasReferenteOtro')
    @slot('hasReferenteOtro_init_expression', 'hasReferenteOtro = false')
    @slot('hasReferenteOtro_value', 'hasReferenteOtro')

    @slot('referente_otro_model', 'referente_otro')
    @slot('newReferente_model', 'newReferente')
    @slot('newReferente_value', 'newReferente')
    @slot('newReferente_init_expression', 'newReferente = false')

    @slot('referente_model', 'referente')
    @slot('referentes_list', 'referentes')
	@slot('referentes_limit', '-20')
{{-- -------------------------------------------------------------------- --}}
{{-- -------------------------------------------------------------------- --}}

    @slot('prioridad_options')
        ng-model="prioridad"
        ng-options="p.name for p in prioridades track by p.id"
    @endslot

    @slot('estado_options')
        ng-model="estado"
        ng-options="e.name for e in estados track by e.id"
    @endslot

    @slot('approval_on', 'estado.id === 1')

    @slot('entrega_inicio_options', 'ng-required=estado.id === 1')
    @slot('entrega_final_options', 'ng-required=estado.id === 1')
    
    @slot('fecha_desde_options')
        ng-model="datePickers.from.date"
        ng-click="datePickers.from.open = true"
        uib-datepicker-popup="dd/MM/yyyy"
        is-open="datePickers.from.open"
        datepicker-options="datePickerOptions.from"
        ng-required="estado.id === 1"
    @endslot
    
    @slot('fecha_hasta_options')
        ng-model="datePickers.to.date"
        ng-click="datePickers.to.open = true"
        uib-datepicker-popup="dd/MM/yyyy"
        is-open="datePickers.to.open"
        datepicker-options="datePickerOptions.to"
        ng-required="estado.id === 1"
    @endslot

@endcomponent
