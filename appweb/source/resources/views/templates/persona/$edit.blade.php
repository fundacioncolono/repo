@component('components.forms.persona')

    @slot('cedula_options')
        ng-model="update.persona.cedula"
        ng-value="selected.persona.cedula"
    @endslot

    @slot('nombre_options')
        ng-model="update.persona.nombre"
        ng-value="selected.persona.nombre"
    @endslot

    @slot('apellidos_options')
        ng-model="update.persona.apellidos"
        ng-value="selected.persona.apellidos"
    @endslot

    @slot('telefonos_options')
        ng-model="update.persona.telefonos"
        ng-value="selected.persona.telefonos"
    @endslot

    @slot('ubicacion_options')
        ng-model="update.persona.ubicacion"
        ng-value="selected.persona.ubicacion"
        field="ubicacion"
        required
    @endslot

    @slot('direccion_options')
        ng-model="update.persona.direccion"
        ng-value="selected.persona.direccion"
    @endslot

    @slot('contactos_options')
        ng-model="update.persona.contactos"
        ng-value="selected.persona.contactos"
    @endslot

@endcomponent
