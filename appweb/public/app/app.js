Date.prototype.toStandardDate = function () { return this.toISOString().substring(0, 10); };

var app = angular.module('App',['ngAnimate', 'ngResource', 'ui.bootstrap']);

app.config(['uibPaginationConfig',function(conf){
	conf.maxSize        = 16;
	conf.boundaryLinks  = true;
	conf.forceEllipses  = true;
	conf.directionLinks = false;
	conf.lastText       = "Último";
	conf.firstText      = "Primero";
}]);

app.config(['uibDatepickerPopupConfig', function (conf) {
	conf.altInputFormats = [];
	conf.currentText     = 'Hoy';
	conf.closeText       = 'Hecho';
	conf.clearText       = 'Limpiar';
	conf.placement       = 'auto bottom';
}]);

app.config(function ($resourceProvider) {
	$resourceProvider.defaults.actions.save.method = 'PATCH';
	$resourceProvider.defaults.actions.update      = { method: 'PUT' };
	$resourceProvider.defaults.actions.post        = { method: 'POST' };
	$resourceProvider.defaults.actions.create      = { method: 'POST' };
});

app.config(function(AppResourceProvider){
	AppResourceProvider.extras = 'fundacioncolono';
});

app.config(function (TerritoryProvider) {
	TerritoryProvider.fields.canton.cod = 'COD_CANT';
	TerritoryProvider.fields.canton.name = 'NOM_CANT_1';
	TerritoryProvider.fields.distrito.cod = 'COD_DIST';
	TerritoryProvider.fields.distrito.name = 'NOM_DIST';

	TerritoryProvider.fields.cantones   = 'COD_PROV,COD_CANT,NOM_CANT_1';
	TerritoryProvider.fields.distritos = 'COD_PROV,COD_CANT,COD_DIST,NOM_DIST';
	TerritoryProvider.fields.all      = 'COD_PROV,COD_CANT,COD_DIST,NOM_PROV,NOM_CANT,NOM_DIST';
	
	TerritoryProvider.orderby.canton = 'COD_CANT';
	TerritoryProvider.orderby.distrito = 'COD_DIST';

	TerritoryProvider.resultWrapper = 'features';
});

// app.filter('standardate')

// SOME BUILT-IN FUNCTIONS
function jQueryToJson(obj, key){
	var data = {}
	obj.find('['+key+']').each(function(index){
		data[this.getAttribute(key)]=this.value;
	});
	return data;
}

function copy(_this, _into = {}, except = []){

	fails = 0;

	if (except.length > 0)
		for (var key in _this) {
			for (var i = 0; i < except.length; i++) 
				if (key === except[i]) 
					fails++;
			if (fails === 0) 
				_into[key] = _this[key];
			fails = 0;
		}

	else 
		for (var key in _this)
			_into[key] = _this[key];

	return _into;
}

function find(key, value, array) {
	for (var i = 0; i < array.length; i++)
		if(array[i][key] == value)
			return array[i];

	return false;
}

function getIndex(list, object){
	for (var i = 0; i < list.length; i++)
		if (angular.equals(list[i], object)) return i;

	return -1;
};
