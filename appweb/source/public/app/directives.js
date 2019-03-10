app.directive('regionSelect', function (AppResource, Region) {

	var link = function (scope, element, attrs) {

		attrs.fillWith = attrs.fillWith || 0;
		attrs.partial = attrs.partial !== undefined;

		scope.required = attrs.required;
		scope.provincias = Region.provincias();
		scope.cantones = [];
		scope.distritos = [];

		scope.updateCantones = function () {
			scope.distritos = [];
			scope.canton = null;
			scope.distrito = null;

			Region.cantones(scope.provincia.cod).then(function(data){
				scope.cantones = Region.parse(data).cantones;
				if (attrs.partial) scope.ngModel = scope.provincia.cod ;
				else scope.ngModel = scope.provincia.cod + '/' + attrs.fillWith + '/' + attrs.fillWith;
			})
			.catch(function(){});
		};

		scope.updateDistritos = function () {
			scope.distrito = null;

			Region.distritos(scope.provincia.cod, scope.canton.cod).then(function (data) {
				scope.distritos = Region.parse(data).distritos;
				if (attrs.partial) scope.ngModel = scope.provincia.cod + '/' + scope.canton.cod;
				else scope.ngModel = scope.provincia.cod + '/' + scope.canton.cod + '/' + attrs.fillWith;
			})
			.catch(function(){});
		};

		scope.updateDistrito = function () {
			scope.ngModel = scope.provincia.cod + '/' + scope.canton.cod + '/' + scope.distrito.cod;
		};

		scope.hasCantones = function () {
			return scope.cantones.length === 0;
		};

		scope.hasDistritos = function () {
			return scope.distritos.length === 0;
		};

		scope.$watch('ngValue', function(n, o, s){
			if (n) {
				var i = n.split('/'), r;
				if (i[0] !== attrs.fillWith && i[1] !== attrs.fillWith && i[2] !== attrs.fillWith)
					Region.text(i[0], i[1], i[2]).then(function(t){
						r = Region.parse(t).location.object;
						s.provincia = r.provincia;
						s.canton = r.canton;
						s.distrito = r.distrito;
						Region.cantones(s.provincia.cod).then(function(c){
							s.cantones = Region.parse(c).cantones;
							Region.distritos(s.provincia.cod, s.canton.cod).then(function(d){
								s.distritos = Region.parse(d).distritos;
							})
							.catch(function(){});
						})
						.catch(function(){});
					})
					.catch(function(){});
			}
		});
	};

	return {
		link:        link,
		scope: {
			field:   '@?',
			partial: '=?',
			ngValue: '=?',
			ngModel: '=',
		},
		restrict:    'E',
		transclude: true,
		templateUrl: AppResource.getUrl() + '/app/templates/region-select.html'
	};
});

app.directive('regionText', function (Region) {
	return {
		template: '{{ubicacion}}',
		restrict: 'A',
		scope:{
			path: '<'
		},
		link: function (scope, element, attrs) {

			scope.$watch("path", function (n, o, s) {

				if (n){
					var data = n.split('/');
					if (data[0] !== '0' && data[1] !== '0' && data[2] !== '0')
						Region.text(data[0], data[1], data[2])
						.then(function (response) {
							s.ubicacion = Region.parse(response).location.text;
						})
						.catch(function (err) {
							element.addClass("text-muted");
							s.ubicacion = 'No se pudo obtener la ubicación.';
							console.error('Could not retrieve region data from service.\nMaybe bad connection?');
						});
				}
			});

		},
	};
});

app.directive('addAyudasModal', function (AppResource) {
    var link = function (scope, element, atts) {
		
		scope.monto = scope.detalle = null;

		scope.getIndex = function (item, items) {
			for (var i = 0; i < items.length; i++)
				if (angular.equals(items[i], item)) return i;

			return -1;
		};

		scope.add = function(){

			var push = {};
			push[scope.value] = scope.selected[scope.value];
			push[scope.label] = scope.selected[scope.label];
			push.monto = scope.monto;
			push.detalle = scope.detalle;

			scope.repository.push(push);
	
			// scope.items.splice(scope.getIndex(scope.selected, scope.items), 1);
			scope.selected = null;
	
			scope.monto = scope.detalle = null;
		};
    };

    return {
        scope: {
            items: '=',
			repository: '=',
			label: '@',
			value: '@',
		},
		replace: true,
        transclude: true,
        restrict: 'E',
        link: link,
        templateUrl: AppResource.getUrl() + '/app/templates/add-ayudas-modal.html'
    }
});