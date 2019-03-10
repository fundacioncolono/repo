@extends('layouts.main')

@push('scripts_top')
	<script src="{{ asset('app/controllers/inspectores/MainController.js') }}" charset="utf-8"></script>
	<script src="{{ asset('app/controllers/inspectores/CreateController.js') }}" charset="utf-8"></script>
@endpush


@push('scripts_bottom')
	@if (Session::has('status'))
		@include('partials._error_alert')
	@endif
@endpush

@section('controller', 'Inspectores')

@section('content')
	<section class="col-md-10 col-md-offset-1"  ng-controller="Inspectores_CreateController">
		<form name="account" class="form-horizontal" action="{{ route('inspectores.store') }}" method="post" autocomplete="off">
			
			{{ csrf_field() }} {{-- PERSONA --}}
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

			{{ csrf_field() }} {{-- USUARIO --}}
			<fieldset class="col-md-5">
				<legend>Cuenta del usuario</legend>
				{{-- IMPORT FORM COMPONENT FOR USUARIO --}}
				@include('partials._usuario')

				<div class="text-center" style="margin-top:5em">
					<button class="btn btn-primary" type="submit" ng-disabled="!account.$valid">Crear cuenta de inspector</button>
				</div>
			</fieldset>



		</form>
	</section>
@endsection
