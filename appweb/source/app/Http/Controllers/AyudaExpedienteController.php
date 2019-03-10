<?php

namespace App\Http\Controllers;

use \App\Models\Expediente;
use \App\Services\AyudaExpedienteService;
use \App\Services\HistoricoService;

use DB;
use Illuminate\Http\Request;

class AyudaExpedienteController extends Controller {

	public function __invoke(Request $request, $id){
		
		$status = true;
		$expediente = Expediente::with(['ayudas', 'persona', 'referente'])->find($id);

		DB::beginTransaction();

		try{
			
			//* Create new record into Historico if record is true
			if (filter_var($request['record'], FILTER_VALIDATE_BOOLEAN))
				$expediente = HistoricoService::create($expediente, $expediente->toArray());

			//* Process attachs
			AyudaExpedienteService::attach($expediente->ayudas(), $request['attachs']);
	
			//* Process detachs
			AyudaExpedienteService::detach($expediente->ayudas(), $request['detachs']);
	
			//* Process updates
			AyudaExpedienteService::update($expediente->ayudas(), $request['updates']);

			//* Reload Ayudas
			$expediente->load('ayudas');

			// All good to commit :)
			DB::commit();
		}

		catch(\Exception $e){
			// Something went wrong :(
			$status = false;
			// Rollback transaction
			DB::rollback();
			throw $e;
		}
		
		$expediente->meses      = $expediente->getMeses($expediente->fecha_desde, $expediente->fecha_hasta);
		$expediente->montoTotal = $expediente->getMontoTotal();

		return response()->json([
			'expediente' => $expediente,
			'status'     => $status,
			'title'      => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
			'type'       => $status ? 'success' : 'error',
			'msg'        => $status ? 'Se realizaron los cambios correctamente.' : 'Es posible que los datos ingresados no sean los correctos.',
			'debug'        => $request->all(),
		]);

	}
}
