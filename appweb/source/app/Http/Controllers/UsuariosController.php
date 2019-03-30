<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;

use DB;
use Filter;

class UsuariosController extends Controller{
    
    const MAX_RECORDS = 16;

    public function comprobar(Request $request)
    {
        
        $usuario = Usuario::where('username', $request['username'] )->first();
        return response()->json([
          'resultado' => $usuario !== null,
        ]);

    }

    public function index()
    {
        
        $usuarios = Usuario::
        orderBy( 'username' , 'asc' )
        ->paginate(self::MAX_RECORDS);

        return response()->json([
          'usuarios' => $usuarios->items(),
          'total' => $usuarios->total()
        ]);

    }

    public function verUsuarios()
    {
        return view('templates.usuarios.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('templates.usuarios.index');
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
            $usuario = new Usuario;
            $usuario->username = $request['username'];
            $usuario->password = $request['password'];
            $usuario->email = $request['email'];
                
            $usuario->save();
        
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

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id){

        $status = true;

        DB::beginTransaction();

        try {
            // $usuario = Usuario::find($id);
            // $usuario->email    = $request['data']['email'];
            // $usuario->username = $request['data']['username'];
            // $usuario->password = $request['data']['password'];

            // $usuario->save();

            $usuario = Usuario::find($id);
            $usuario->email    = $request['email'];
            $usuario->username = $request['username'];
            $usuario->password = $request['password'];

            $usuario->update();
            DB::commit();
        }
        catch (Exception $e) {
            $status  = false;
            DB::rollback();
        }

        return response()->json([
            'status' => $status,
            'title' => $status? 'Ok' : 'Error',
            'msg' => $status? 'Everything ok' : 'Baby don\'t worry about nothing, \'cause every little thing is gonna be alright',
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
        $status = Usuario::destroy($id) === 1;

        return response()->json([
            'status' => $status,
            'title'  => $status ? '¡Operación exitosa!' : 'Ocurrió un fallo.',
            'type'   => $status ? 'success' : 'error',
            'msg'    => $status ? 'Se removió el expediente correctamente.': 'Si el problema persiste, por favor contacte con soporte.',
        ]);

    }
}
