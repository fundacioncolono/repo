<?php

namespace App\Http\Controllers;

use App\Models\Visita;
use App\Models\Expediente;
use App\Models\Inspector;

use Illuminate\Http\Request;
use DB;

class VisitasController extends Controller
{
    const MAX_RECORDS = 8;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){
        $arrayExpediente = Visita::with(['expediente'])->get()->pluck('expediente.id')->all();

        $expedientes = Expediente::with( ['persona'] )
        ->whereNotIn('id', $arrayExpediente)
        ->orderBy( 'persona_fk' , 'asc' )
        ->paginate(self::MAX_RECORDS);

        return response()->json([
          'expedientes' => $expedientes->items(),
          'total' => $expedientes->total()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Visita::destroy($id) === 1;

        return response()->json([
            'status' => $status,
            'title'  => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
            'type'   => $status ? 'success' : 'error',
            'msg'    => $status ? 'Se removió el expediente correctamente.': 'Si el problema persiste, por favor contacte con soporte.',
        ]);
    }
}
