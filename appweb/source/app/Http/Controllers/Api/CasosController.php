<?php

namespace App\Http\Controllers\Api;

use App\Models\Expediente;
use App\Models\Historico;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class CasosController extends Controller{
    
    public function index($id){

        DB::beginTransaction();  
        
        try{
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

            DB::commit();

        }catch (Exception $e) {
            
            DB::rollback();
        }

        return response()->json([
            'vigente' => $current,
            'historico' => $historico,
            'debug' => ['currentQuery' => $currentQuery, 'historicoQuery' => $historicoQuery]
        ]);
    }

}