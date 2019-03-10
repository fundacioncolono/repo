<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;

use DB;

class PersonasController extends Controller{

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id){

		$status = true;
		$persona = Persona::find($id);

		DB::beginTransaction();

		try {

			$persona->fill($request['persona']);
			$persona->save();

			DB::commit();
		}
		catch (Exception $e) {
			$status  = false;
			DB::rollback();
		}

		return response()->json([
			'status' => $status,
			'title'  => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
			'type'   => $status ? 'success' : 'error',
			'msg'    => $status ? 'Se realizaron los cambios correctamente.' : 'Es posible que los datos ingresados no sean los correctos.',
			'persona'   => $persona,
		]);
	}

	public function show($id)
	{
		return Persona::find($id);
	}
	
}
