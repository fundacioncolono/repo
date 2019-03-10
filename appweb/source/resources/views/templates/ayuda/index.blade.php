@extends('layouts.main') 

@push('scripts_top')
	<script src="{{ asset('app/controllers/ayudas/MainController.js') }}" charset="utf-8"></script>
	<script src="{{ asset('app/controllers/ayudas/IndexController.js') }}" charset="utf-8"></script>
@endpush

@section('content')
	<ng-controller ng-controller="Ayudas_MainController">
		<section id="ayudas" class="col-md-10 col-md-offset-1" ng-controller="Ayudas_IndexController">

			<!-- TABLA DE inspectores -->
			<div class="table-responsive col-sm-8" style="margin-left: 15%">
				<h3 class="text-center">
					Ayudas 
					<button type="button" class="btn btn-success pull-right" ng-click="show(null, 0);" data-toggle="modal" data-target="#modalOpcion">Agregar</button>
				</h3>
				<table id="index" class="table table-hover table-striped">
					<thead style="background-color: #e7e7e7; color: #555;">
						<tr>
							<th ng-show="columns.descripcion" style="width: 80%">
								<h4><Strong>Descripcion</Strong></h4>
							</th>
							<th ng-show="columns.opciones">
								<h4><Strong>Opciones</Strong></h4>
							</th>
						</tr>
					</thead>
					<tbody>
						<tr ng-class="{'active' : a.isSelected}" ng-repeat="a in ayudas"ng-cloak>
							<td ng-show="columns.descripcion" style="width: 80%;">@{{ a.descripcion }}</td>
							<td>
								<button type="button" class="btn btn-sm btn-outline btn-edit" ng-click="show(a, 1)" data-toggle="modal" data-target="#modalOpcion">Editar</button>
								<button type="button" class="btn btn-sm btn-outline btn-delete" ng-click="show(a, 2)" data-toggle="modal" data-target="#modalOpcion">Eliminar</button>
							</td>
						</tr>
					</tbody>
				</table>
			</div>
	
			<div class="text-center col-sm-8" style="margin-left: 15%">
				<ul uib-pagination total-items="total" class="pagination-sm" ng-model="page" items-per-page="16" ng-change="index(page)"></ul>
			</div>

			  <!-- Modal agregar -->
			<div class="modal fade" id="modalOpcion" role="dialog" style="margin-top: 10%;" ng-model='modalOpciones'>
			    <div class="modal-dialog modal-md">
			      	<div class="modal-content">

			        	<div class="modal-header" style="background-color: @{{ opcion == 0 ? '#5cb85c' : opcion == 1 ? '#337ab7' : '#c9302c'}}; color: white;text-align: center;color: white;">
			          		<button type="button" class="close" ng-click="closeModal()">&times;</button>
			          		<h4 class="modal-title">
			          			@{{ opcion === 0 ? 'Agregar' : opcion === 1 ? 'Editar' : 'Eliminar' }} ayuda</h4>
			        	</div>
			        	
			        	<div class="modal-body" style="height: 100px;">
			        		
			        		<h4 style="display:@{{ opcion === 2 ? 'block' : 'none' }}; margin-top: 20px;text-align:center;">¿Deseas eliminar la ayuda @{{ selected.descripcion }}?</h4>
							
							<div class="form-group" style="display:@{{ opcion !== 2 ? 'block' : 'none' }};position: relative;top:35%;left:7%;">
							    <label class="col-sm-3 col-form-label" style="margin-top: 5px;" for="descripcion">Descripción:</label>
							    <div class="col-sm-7">
							        <input type="text" class="form-control" id="descripcion" placeholder="Ingrese la descripción" ng-model="update.descripcion" required />
							    </div>
							</div>
			        	
			        	</div>
			        	<div class="modal-footer">
			          		<button type="button" class="btn-outline btn-default" ng-click="closeModal()" style="height: 30px;border-radius: 5px;">Cancelar</button>
			        		<button type="button" class="btn-outline btn-@{{ opcion == 0 ? 'show' : opcion == 1 ? 'edit' : 'delete'}}" 
			        			ng-click=" opcion === 0 ? add() : opcion === 1 ? edit() : delete()" style="height: 30px;border-radius: 5px;">
			        			@{{ opcion === 0 ? 'Agregar' : opcion === 1 ? 'Guardar cambios' : 'Aceptar' }}
			        		</button>
			        	</div>
			      	</div>
			    </div>
			</div>

		</section>
	</ng-controller>
@endsection