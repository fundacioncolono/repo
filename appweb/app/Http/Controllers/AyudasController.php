<?php

namespace App\Http\Controllers;

use App\Models\Ayuda;
use Illuminate\Http\Request;
use DB;
use Filter;

class AyudasController extends Controller
{
    
    const MAX_RECORDS = 16;
    
    public function index(Request $request){

        $ayudas = Ayuda::
        orderBy( 'descripcion' , 'asc' )
        ->paginate(self::MAX_RECORDS);

        return response()->json([
          'ayudas' => $ayudas->items(),
          'total' => $ayudas->total()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function verAyudas()
    {
        //return response()->json(Ayuda::all());
        return view('templates.ayuda.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates.create.index');
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
            $ayuda = new Ayuda;
            $ayuda->descripcion = $request['descripcion'];
            $ayuda->save();
        
            DB::commit();
        
        }catch(\Exception $e){
            $status = false;
            DB::rollback();
            throw $e;
        }

        return response()->json([
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

    public function update(Request $request, $id){
        
        $status = true;
        $ayuda = Ayuda::find($request['id']);

        DB::beginTransaction();

        try {

            $ayuda->fill($request['ayuda']);
            $ayuda->update();

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
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $status = Ayuda::destroy($id) === 1;

        return response()->json([
            'status' => $status,
            'title'  => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
            'type'   => $status ? 'success' : 'error',
            'msg'    => $status ? 'Se removió el expediente correctamente.': 'Si el problema persiste, por favor contacte con soporte.',
        ]);
    }
}
