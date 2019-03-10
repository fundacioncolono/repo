<p class="ayudas-empty" ng-show="items.length === 0"> Aún no tiene ayudas asignadas </p>

{{-- UIBOOTSTRAP ACCORDION --}}
<uib-accordion close-others="true">
    <div uib-accordion-group class="addayudas panel-default" ng-repeat="i in items">

        <input type="hidden" name="ayudas[@{{$index}}][id]" ng-value="i.id">

        <uib-accordion-heading>
            <span>@{{ i.descripcion }}</span>
            <button class="pull-right btn-sm btn-outline btn btn-delete" ng-click="remove($index)">
                Quitar <span class="glyphicon glyphicon-minus"></span>
            </button>
        </uib-accordion-heading>


        <div class="form-group">
            <label class="control-label col-md-4">Monto base:</label>
            <div class="col-md-3 col-lg-pull-1">
                <input class="form-control"ype="text" name="ayudas[@{{$index}}][monto]" ng-value="i.monto">
            </div>
        </div>

        <div class="form-group">
            <label class="col-md-12">Detalle:</label>
            <div class="col-md-11">
                <textarea name="ayudas[@{{$index}}][detalle]" class="form-control noresize" cols="5" rows="5">@{{ i.detalle }}</textarea>
            </div>
        </div>
    </div>
</uib-accordion>
