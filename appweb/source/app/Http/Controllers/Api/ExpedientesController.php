<?php

namespace App\Http\Controllers\Api;

use App\Models\Expediente;
use App\Models\Visita;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ExpedientesController extends Controller{
    
    public function index(Request $request){

        DB::beginTransaction();

        try {

            $arrayExpediente = Visita::with(['expediente'])->get()->pluck('expediente.id')->all();

            $expedientes = Expediente::with( ['persona'] )
            ->whereNotIn('id', $arrayExpediente)
            ->where('estado', 3)
            ->orderBy( 'persona_fk' , 'asc' )
            ->get();
            
            DB::commit();

        }
        catch (Exception $e) {
            DB::rollback();
        }

       return response()->json([
          'expedientes' => $expedientes,
        ]);
        
    }

     public function store(Request $request){
        $status = true;
        DB::beginTransaction();
        
        try{
            $visita = new Visita;
            $visita->inspector_fk = $request['inspector_fk'];
            $visita->expediente_fk = $request['expediente_fk'];
            $visita->save();
        
            DB::commit();
        
        }catch(\Exception $e){
            $status = false;
            DB::rollback();
            throw $e;
        }

        $visitas = Visita::with(['expediente.persona'])
            ->where('inspector_fk', $request['inspector_fk'])->get();

        return response()->json([
            'visitas' => $visitas,
            'status' => $status,
            'title'  => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
            'type'   => $status ? 'success' : 'error',
            'msg'    => $status ? 'Se asignó el expediente correctamente.': 'Si el problema persiste, por favor contacte con soporte.',

        ]);
    }
}