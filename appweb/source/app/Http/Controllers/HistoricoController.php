<?php

namespace App\Http\Controllers;

use App\Models\Expediente;
use App\Models\Historico;

use Illuminate\Http\Request;
use DB;

class HistoricoController extends Controller
{

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id){
		$currentBuilder = Expediente::with(['persona', 'ayudas'])->whereHas('persona', function($query) use ($id){
			$query->where('cedula', $id);
		});
		
		$currentQuery = $currentBuilder->toSql();
		$current = $currentBuilder->first();

		$historicoBuilder = Historico::with(['expediente.referente', 'expediente.ayudas'])
			->whereHas('expediente.persona', function ($query) use ($id){
				$query->where('cedula', $id);
			});

		$historicoQuery = $historicoBuilder->toSql();
		$historico = $historicoBuilder->get();

		return response()->json([
			'vigente' => $current,
			'historico' => $historico,
			'debug' => ['currentQuery' => $currentQuery, 'historicoQuery' => $historicoQuery]
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id)
	{
		//
	}

	public function destroy($id)
	{
		//
	}
}
