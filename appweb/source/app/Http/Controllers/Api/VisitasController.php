<?php

namespace App\Http\Controllers\Api;

use App\Models\Visita;
use App\Models\Expediente;
use App\Models\Inspector;
use App\Models\Historico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class VisitasController extends Controller{
    
    public function index(Request $request)
    {

        DB::beginTransaction();

        try {

            if($request['tipo'] == 'visita'){

                $expedientes = Visita::with(['expediente.persona'])->get()
                ->whereIn('inspector_fk', $request['inspector_fk'])
                ->where('fecha_visita', '')
                ->where('expediente.estado', 3)
                ->all();

            }else if($request['tipo'] == 'casosSeguidos'){

                $expedientes = Visita::with(['expediente.persona'])->get()
                ->whereIn('inspector_fk', $request['inspector_fk'])
                ->where('fecha_visita', '<>', '')
                ->where('expediente.estado', 3)
                ->all();
                
            }else if($request['tipo'] == 'casosFinalizados'){

                $expedientes = Visita::with(['expediente.persona'])->get()
                ->whereIn('inspector_fk', $request['inspector_fk'])
                ->where('fecha_visita', '<>', '')
                ->whereIn('expediente.estado', [1, 2])
                ->all();

            }

            DB::commit();

        }
        catch (Exception $e) {
            DB::rollback();
        }

       return response()->json([
          'expedientes' => $expedientes,
        ]);

    }

    public function store(Request $request)
    {
        $status = 1;
        DB::beginTransaction();

        $expedientesAsignar = [];
        $expedientesAsignar = json_decode($request['listaExpedientes'], true);;

        try{

            foreach ($expedientesAsignar as &$expediente) {

                $visita = new Visita;
                $visita->inspector_fk = $request['inspector_fk'];
                $visita->expediente_fk = $expediente['id'];
                $visita->save();

            }

            DB::commit();
        
        }catch(\Exception $e){
            $status = 0;
            DB::rollback();
            throw $e;
        }

        return response()->json([
          'resultado' => $status,
        ]);
    }

    public function update(Request $request){

        $resultado = true;

        DB::beginTransaction();

        try {
     
            $visitas = Visita::where('id', $request['id'])->first();
            $visitas->fecha_visita    = $request['fecha_visita'];
            $visitas->observaciones = $request['observaciones'];

            $visitas->update();
            DB::commit();
        
        }catch (Exception $e) {
            $resultado  = false;
            DB::rollback();
        }

        return response()->json([
            'resultado' => $resultado,
        ]);
        
    }

}
