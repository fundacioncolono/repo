
app.service('Typeahead', function(){
	this.formatter = function(model, list, select, label){
		for (var i = 0; i < list.length; i++)
			if (model === list[i][select]) 
				return list[i][label];
	};
});

app.service('Region', function($cacheFactory, $resource, Territory){

	var provincias = [
		{cod: '1', name: 'SAN JOSÉ'},
		{cod: '2', name: 'ALAJUELA'},
		{cod: '3', name: 'CARTAGO'},
		{cod: '4', name: 'HEREDIA'},
		{cod: '5', name: 'GUANACASTE'},
		{cod: '6', name: 'PUNTARENAS'},
		{cod: '7', name: 'LIMÓN'}
	],
	
	textCache = $cacheFactory('textCache'),
	cantonesCache = $cacheFactory('cantonesCache'),
	distritosCache = $cacheFactory('distritosCache'),

	parseText = function(data){

		data = data[Territory.wrapper];

		var object = {
			provincia: {
				cod: data[0]['attributes']['COD_PROV'],
				name: data[0]['attributes']['NOM_PROV'],
			},
			canton: {
				cod: data[0]['attributes']['COD_CANT'],
				name: data[0]['attributes']['NOM_CANT'],
			},
			distrito: {
				cod: data[0]['attributes']['COD_DIST'],
				name: data[0]['attributes']['NOM_DIST'],
			},
		};

		return {
			text: object.provincia.name + ', ' + object.canton.name + ', ' + object.distrito.name,
			object: object,
		};
	},

	parseDistritos = function (data) {

		var list = [];
		data = data[Territory.wrapper];

		for (var i = 0; i < data.length; i++)
			list.push({
				cod: data[i]['attributes'][Territory.fields.distrito.cod],
				name: data[i]['attributes'][Territory.fields.distrito.name]
			});

		return list;
	},

	parseCantones = function (data) {

		var list = [];
		data = data[Territory.wrapper];

		for (var i = 0; i < data.length; i++)
			list.push({
				cod: data[i]['attributes'][Territory.fields.canton.cod],
				name: data[i]['attributes'][Territory.fields.canton.name]
			});

		return list;
	};

	this.provincias = function () {
		return provincias;
	};

	this.cantones = function (provincia) {
		return cantonesCache.get(provincia) ?
			   cantonesCache.get(provincia) :
			   cantonesCache.put(provincia, $resource(Territory.urls.canton).get(Territory.cantones(provincia)).$promise);
	};

	this.distritos = function (provincia, canton) {
		return distritosCache.get(provincia + '/' + canton) ?
			   distritosCache.get(provincia + '/' + canton) :
			   distritosCache.put(provincia + '/' + canton, $resource(Territory.urls.distrito).get(Territory.distritos(provincia, canton)).$promise);
	};

	this.text = function (provincia, canton, distrito) {
		return textCache.get(provincia + '/' + canton + '/' + distrito) ?
			   textCache.get(provincia + '/' + canton + '/' + distrito) :
			   textCache.put(provincia + '/' + canton + '/' + distrito, $resource(Territory.urls.distrito).get(Territory.all(provincia, canton, distrito)).$promise);
	};
	
	//* Some other functions...
	this.find = function(array, key, value) {
		for (var i = 0; i < array.length; i++)
		if(array[i][key] == value) 
		return array[i];
	};

	// this.reverse = function (data) {
	// 	return "/" + "/" + ;
	// };

	this.parse = function (data) {

		if (data[Territory.wrapper].length > 0)
			return {
				location: parseText(data),
				cantones: parseCantones(data),
				distritos: parseDistritos(data),
			};
		else return false;
	};

});

app.service('Modal', function(){

	var instance;

	this.init = function(selector, settings = {}){
		instance = $(selector).animatedModal(settings);
		return instance;
	};

	this.setSettings = function(settings, mergeSettings = false){
		instance.applySettings(settings, mergeSettings);
		return instance;
	};

	this.getSettings = function(){ return instance.getSettings(); };

	this.getInstance = function() { return instance; };

});
