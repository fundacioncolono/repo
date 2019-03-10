<article id="selectedpersona" class="col-md-4 col-md-offset-1" ng-class="{'editing': selected.persona.editable}" ng-controller="Personas_EditController">
    <header>
        <h3>
            Datos de la persona
            <small>@{{ (selected.persona.editable)? '(en edición)' : '' }}</small>
        </h3>
        <hr>
    </header>

    <section class="expediente-info form-horizontal" ng-if="selected.persona.editable">
        <div class="controls">
            <button type="button" class="btn-outline btn btn-show" ng-click="updatePersona()">
                <span class="glyphicon glyphicon-ok"></span> Aceptar cambios</button>
            <button type="button" class="close" title="Cancelar edición" ng-click="selected.persona.editable = false">&times;</button>
        </div>

        {{-- INCLUDE PERSONA FORM COMPONENT --}}
        @include('templates.persona.$edit')
    </section>

    <section class="expediente-info" ng-hide="selected.persona.editable">

        <button type="button" class="btn-outline btn btn-edit btn-sm" ng-click="edit()">
            <span class="glyphicon glyphicon-pencil"></span> 
            <span class="hidden-xs">Editar</span>
        </button>

        <div class="expediente-info-item">
            <label>Cédula: </label>
            <span>@{{ selected.persona.cedula }}</span>
        </div>

        <div class="expediente-info-item">
            <div>
                <label>Nombre completo: </label>
                <span>@{{ selected.persona.nombre + ' ' + selected.persona.apellidos }}</span>
            </div>
        </div>

        <div class="expediente-info-item">
            <label>Teléfono(s): </label>
            <span>@{{ selected.persona.telefonos }}</span>
        </div>

        <div class="expediente-info-item">
            <label>Ubicación: </label>
            <span region-text path="selected.persona.ubicacion"></span>
        </div>

        <div class="expediente-info-item">
            <label>Dirección exacta: </label>
            <p>@{{ selected.persona.direccion }}</p>
        </div>

        <div class="expediente-info-item">
            <label>Contacto(s): </label>
            <p>@{{ selected.persona.contactos }}</p>
        </div>

    </section>
</article>
