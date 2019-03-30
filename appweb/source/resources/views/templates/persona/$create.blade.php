@component('components.forms.persona')

    @slot('cedula_options')
        ng-model="persona.cedula"
    @endslot

    @slot('nombre_options')
        ng-model="persona.nombre"
    @endslot

    @slot('apellidos_options')
        ng-model="persona.apellidos"
    @endslot

    @slot('telefonos_options')
        ng-model="persona.telefonos"
    @endslot
    
    @slot('ubicacion_options')
        ng-model="update.persona.ubicacion"
        field="ubicacion"
    @endslot

    @slot('direccion_options')
        ng-model="persona.direccion"
    @endslot

    @slot('contactos_options')
        ng-model="persona.contactos"
    @endslot

@endcomponent
