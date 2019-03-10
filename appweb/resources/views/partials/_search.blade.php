<div class="row col-lg-3 col-lg-offset-3">
	<form>
		<div class="input-group">
			<input type="text" class="form-control" placeholder="Buscar por @{{ search.property }}" ng-model="search.value" ng-change="index()"/>
			<button class="input-btn" title="Limpiar búsqueda" ng-click="clear()" ng-class="{'hidden': !search.value || search.value === ''}"><span class="glyphicon glyphicon-erase"></span></button>
			<div class="input-group-btn">
				<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="glyphicon glyphicon-search text-muted"></span>
				</button>
				<ul class="dropdown-menu dropdown-menu-right" style="padding: .5em 1em">
					<li class="dropdown-header">Buscar por:</li>
					<li><label class="control-label" style="font-weight: 100"><input type="radio" ng-model="search.property" value="cedula"> Cédula</label></li>
					<li><label class="control-label" style="font-weight: 100"><input type="radio" ng-model="search.property" value="nombre"> Nombre</label></li>
					<li><label class="control-label" style="font-weight: 100"><input type="radio" ng-model="search.property" value="apellidos"> Apellidos</label></li>
				</ul>
			</div>
		</div>
	</form>
</div>