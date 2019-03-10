@extends('layouts.main')

@push('scripts_top')
	<script src="{{ asset('app/controllers/expedientes/MainController.js') }}" charset="utf-8"></script>
	<script src="{{ asset('app/controllers/expedientes/CreateController.js') }}" charset="utf-8"></script>
	<script id="/region-select.html" type="text/ng-template" src="{{ asset('app/templates/region-select.html') }}"></script>
	<script id="/add-ayudas-modal.html" type="text/ng-template" src="{{ asset('app/templates/add-ayudas-modal.html') }}"></script>
@endpush

@section('controller', 'Expedientes')

@section('content')
	<ng-controller ng-controller="Expedientes_MainController">
		<section class="col-md-10 col-md-offset-1 col-sm-10 col-sm-offset-1" ng-controller="Expedientes_CreateController">

			{{-- ADD AYUDAS MODAL (ANGULARJS DIRECTIVE) --}}
			<div id="ayudasModal" class="modal fade" tabindex="-1" role="dialog">
				<div class="modal-dialog" role="document">
					<add-ayudas-modal items="ayudas" repository="items" label="descripcion" value="id"></add-ayudas-modal>
				</div>
			</div>

			<form name="newexpediente" class="form-horizontal" action="{{ route('expedientes.store') }}" method="POST">

				{{ csrf_field() }}
				
				{{-- PERSONA --}}
				<fieldset class="col-md-5">
					<legend>Detalles de la persona</legend>
					
					{{-- PERSONA COMPONENT --}}
					@component('components.forms.persona')
						@slot('cedula_help')
							<p class="help-block">
								<small>Reemplace las equis (x) por los números de la cédula correspondiente.</small>
							</p>
							<p class="help-block" ng-show="invalid">
								<span class="text-danger">Esta cédula no es válida. Por favor, ingrese otra cédula.</span>
							</p>
						@endslot

						@slot('cedula_options')
							ng-model="cedula"
							ng-change="validate()"
						@endslot

						@slot('ubicacion_options')
							ng-model="ubicacion"
							field="ubicacion"
							required
						@endslot
					@endcomponent

				</fieldset>

				<div class="col-md-1 hidden-xs hidden-sm"></div>

				{{-- EXPEDIENTE --}}
				<fieldset class="col-md-5">
					<legend>Detalles del caso</legend>
					{{-- IMPORT FORM COMPONENT FOR PERSONA --}}
					@include('templates.expediente.$create')
				</fieldset>

				{{-- AYUDAS --}}
				<fieldset class="col-md-5 col-md-offset-1 controls">
					<legend>
						Ayudas solicitadas
						<button type="button" class="btn-outline btn btn-show btn-sm pull-right" title="Agregar ayudas" style="margin-bottom: 5px" data-toggle="modal" data-target="#ayudasModal">
							<span class="glyphicon glyphicon-plus"></span>
							<span class="hidden-xs">Agregar ayudas</span>
						</button>
					</legend>
					@include('templates.ayuda.preview_pivot')

					<div class="form-group text-center">
						<button type="submit" class="btn btn-primary" ng-disabled="newexpediente.$invalid">Guardar expediente</button>
					</div>
				</fieldset>
			</form>
		</section>
	</ng-controller>
@endsection
