<?php

namespace App\Http\Controllers\Api;

use App\Models\Usuario;
use App\Models\Persona;
use App\Models\Inspector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use DB;

class UsuariosController extends Controller{
    
    public function comprobarSesion(Request $request){


        DB::beginTransaction();

        try {

            $resultado = Auth::attempt(['username' => $request['username'], 'password' => $request['password']]);
            $usuario = Usuario::where('username', $request['username'])->first();
            $inspector = Inspector::where('usuario_fk', $usuario->id)->where('activo', 1)->first();
            $persona = Persona::where('cedula', $inspector->persona_fk )->first(); 

            if( is_null($inspector) ){
                 $resultado = false;
            }

        }catch (Exception $e) {
            $resultado  = false;
            DB::rollback();
        }

        return response()->json([
          'resultado' => $resultado,
          'inspector' => $inspector,
          'usuario' => $usuario,
          'persona' => $persona,
        ]);

    }

    public function update(Request $request){

        $resultado = true;

        DB::beginTransaction();

        try {
     
            $usuario = Usuario::where('username', $request['username'])->first();
            $usuario->email    = $request['email'];
            $usuario->username = $request['username'];
            $usuario->password = $request['password'];

            $usuario->update();
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
