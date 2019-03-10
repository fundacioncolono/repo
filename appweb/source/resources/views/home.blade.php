@extends('layouts.main')

@push('scripts_top')
    <script src="{{ asset('app/controllers/transacciones/MainController.js') }}"></script>
@endpush

@section('content')

	<div class="col-md-4 col-md-offset-1" ng-controller="Transacciones_MainController">
		
		<h3 class="page-header">
			Entregas pendientes
			<!-- <small style="display: flex; font-size: small">
				Leyenda
				<span class="">Meses aprobados <span class="glyphicon glyphicon-ok-circle"></span></span>
				<span class="">Meses restantes <span class="glyphicon glyphicon-time"></span></span>
				<span class="">Entregas pendientes <span class="glyphicon glyphicon-warning-sign"></span></span>
			</small> -->
		</h3>
		
		<div class="panel panel-default" ng-repeat="t in transactions track by t.id">
			<div class="panel-heading">
                Aprobado del <b>@{{ t.formatted_fecha_desde }}</b> al <b>@{{ t.formatted_fecha_hasta }}</b>
				<!-- <div class="nogutters col-md-4 col-sm-12 text-nowrap" style="display: flex">
					<span class="delivery-badge approved">5 <span class="glyphicon glyphicon-ok-circle"></span></span>
					<span class="delivery-badge remaining">4 <span class="glyphicon glyphicon-time"></span></span>
					<span class="delivery-badge pending">2 <span class="glyphicon glyphicon-warning-sign"></span></span>
				</div> -->
				<button class="close" ng-click="dismiss($index)">&times;</button>
			</div>

			<div class="panel-body">
				<p>Está pendiente la entrega de las ayudas de este caso</p>

				<label>Expediente.</label>
				<table class="table table-condensed">
					<tbody>
						<tr>
							<td>@{{ t.persona.cedula }}</td>
							<td>@{{ t.persona.nombre }}</td>
							<td>@{{ t.persona.apellidos }}</td>
							<td class="text-nowrap">
                                <label>Prioridad</label>
                                <span class="label" ng-class="{'label-success': t.prioridad === 1, 'label-warning': t.prioridad === 2, 'label-danger': t.prioridad === 3}">
                                    @{{
                                        t.prioridad === 1 ? 'Baja' : 
                                        t.prioridad === 2 ? 'Media' : 
                                        t.prioridad === 3 ? 'Alta' : ''
                                    }}
                                </span>
                            </td>
						</tr>
					</tbody>
				</table>

				<label>Ayudas. <a class="btn btn-sm btn-link" ng-click="collapse($event)">ver/ocultar</a></label>
				<div class="col-lg-12 collapse">
					<ul class="list-group list-group-sm">
						<li class="row list-group-item" ng-repeat="a in t.ayudas">
                            <div class="nogutters col-lg-8" style="padding-top: 6px">@{{ a.descripcion }}</div>
                            <div class="nogutters text-right col-lg-4">
                                <button class="btn-sm btn btn-outline btn-show">Registrar entrega</button>
                            </div>
						</li>
					</ul>
                </div>
				<div class="panel-controls col-lg-12 text-right">
					<button class="btn btn-sm btn-outline btn-edit">Ver expediente</button>
				</div>
			</div>
		</div>

	</div>
@endsection