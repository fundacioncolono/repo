<div class="row" style="padding-top: 10px; width:1350px">
    <form ng-submit="filter_activo()">
        {{-- activo --}}
        <div class="col-lg-2" style="width:130px">
            <div class="form-group-sm form-group">
                <label>
                    Activo
                    <input type="radio" name="filter" ng-model="filter_data.filter" value="activo">
                    <!-- PUT THIS INTO DIRECTIVE -->
                    <ngIf ng-if="filter_data.filter === 'activo'">
                        <input type="hidden" name="property" value="activo">
                        <input type="hidden" name="comparator" value="=">
                        <input type="hidden" name="value" ng-value="filter_data.activo.id">
                    </ngIf>
                </label>
                <select class="form-control" ng-model="filter_data.activo" ng-options="a as a.name for a in activos track by a.id" style="width:100px"></select>
            </div>
        </div>

        {{-- CONTROLES --}}
        <div class="col-lg-2" style="padding-top:15px;">
            <div class="form-group-sm form-group">
                <div class="text-right">
                    <ngShow ng-show="filter_data.filter">
                        <button class="btn-outline btn btn-show" type="submit">
                            <span class="glyphicon glyphicon-ok"></span> Filtrar
                        </button>
                        <button class="btn-outline btn btn-none" type="button" ng-click="filter_data.active = false; filter_data.filter = filter_data.filtered ? filter_data.filter : null" data-toggle="collapse" data-target="#filter">Cancelar</button>
                    </ngShow>
                </div>
            </div>
        </div>
    </form>
</div>
