<div class="row col-lg-6 col-lg-offset-4">
    <form>
        <div class="col-lg-6">
            <div class="input-group">
                  <!-- busqueda -->
                <input type="text" class="form-control" placeholder="Buscar inspector" ng-model="search" ng-change="index()"> 
                <button class="input-btn" title="Limpiar búsqueda" ng-click="clear()" ng-class="{'hidden': !search || search === ''}"><span class="glyphicon glyphicon-erase"></span></button>

                <div class="input-group-btn">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="glyphicon glyphicon-search text-muted"></span>
                    </button>
                </div>
            </div>  
        </div>
        <div class="col-lg-6">
        <!-- filtrar -->
            
            <button class="btn-outline btn btn-none" ng-init="filter_active = false" ng-click="filter_active = !filter_active; filter_init()" style="margin: 0 4px" type="button" data-toggle="collapse" data-target="#filter">
                Filtrar
                <span class="caret" ng-class="{'caret-right': !filter_active}"></span>
            </button>

            <button class="btn-outline btn btn-edit" type="button" ng-show="filter_data.filtered" ng-click="filter_desactivado()">Ver todos</button>
        </div>
        
    </form>
</div>
