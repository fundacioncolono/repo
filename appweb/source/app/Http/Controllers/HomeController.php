<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Expediente;

class HomeController extends Controller
{
	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	
	public function index() {
		return view('home');
	}
	
	public function all()
	{
		// Obtener la fecha de hoy
		$today = new \DateTime();
		// Obtener el día
		$today_day = $today->format('d');
		// Obtener la fecha en el formato Año/Mes/Día
        $today_string = $today->format('Y/m/d');
        // Obtener el string del mes pasado
        $past_month = (new \DateTime())->modify('-1 month')->format('Y/m/d');
	
		$pending_transactions = Expediente::with('persona')
			// Consultar los expedientes donde:
			// 1. La fecha actual está entre fecha_desde y fecha_hasta
			// 2. El día actual está entre entrega_inicio y entrega_final
			->where([
				['fecha_desde', '<=', $today_string],
				['fecha_hasta', '>=', $today_string],
			])
			// Ordenar por fecha_desde
			->orderBy('fecha_desde')
			// Obtener array de resultados (implementa interfaz Collections de Laravel)
			->get()
			
			// Filtrar los expedientes donde la lista de ayudas no esté vacía
			// Es decir, no mostrar expedientes con una lista de ayudas vacía
			// ->filter(function ($expediente) use($today){
			// 	return $expediente->ayudas->isNotEmpty();
			// })
			// ->values()
			// Iterar sobre la lista de resultados
			->each(function($expediente) use($today, $past_month){
				// Formatear las fechas en formato de la región     -------------------------------------------
				$expediente->formatted_fecha_desde = (new \DateTime($expediente->fecha_desde))->format('d/m/Y');
				$expediente->formatted_fecha_hasta = (new \DateTime($expediente->fecha_hasta))->format('d/m/Y');
                
                // Obtener las transacciones donde el maximo valor de la fecha de creacion sea menor al mes anterior de la fecha presente
                $expediente->transacciones = $expediente->transacciones()
                ->groupBy('fecha_creacion')
                ->havingRaw("max(fecha_creacion) < '$past_month'")
                ->get()
                ->each(function($item){ $item->ayudaExpediente; })
                ->pluck('ayudaExpedientes.ayuda_fk');
                
                // Consultar las ayudas que no están en la lista de transacciones hechas
                $expediente->ayudas = $expediente->ayudas()
                ->whereNotIn('ayudas.id', $expediente->transacciones)
                ->get();
			});
            
			return response()->json($pending_transactions);
		}
}
