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

		<form name="account" class="form-horizontal" action="{{ route('inspectores.store') }}" method="post" autocomplete="off" novalidate>
			
			{{ csrf_field() }}
			
			{{-- PERSONA --}}
			<fieldset class="col-md-5">

				<legend>Detalles de la persona</legend>
				
				{{-- PERSONA COMPONENT --}}
				 @include('templates.persona.$create')
			</fieldset>		

			<div class="col-md-1 hidden-xs hidden-sm"></div>

			{{ csrf_field() }} {{-- USUARIO --}}
			<fieldset class="col-md-5">
				
				<legend>Cuenta del usuario</legend>
				{{-- IMPORT FORM COMPONENT FOR USUARIO --}}
				@include('partials._usuario')
				
				<div class="text-right" style="margin-top: 20px">
					<button class="btn btn-primary" ng-disabled="account.$invalid" type="submit" ng-blur="account.$setUntouched()">Crear cuenta de inspector</button>
				</div>

			</fieldset>
		
		</form>

	</section>
@endsection
