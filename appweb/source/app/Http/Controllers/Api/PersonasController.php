<?php

namespace App\Http\Controllers\Api;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

use DB;

class PersonasController extends Controller{
    
    public function update(Request $request){

        $resultado = true;

        DB::beginTransaction();

        try {

            $persona = Persona::where('cedula', $request['cedula'])->first();
            $persona->nombre = $request['nombre'];
            $persona->apellidos = $request['apellidos'];
            $persona->telefonos    = $request['telefonos'];
            $persona->ubicacion = $request['ubicacion'];
            $persona->direccion = $request['direccion'];
            $persona->contactos    = $request['contactos'];
            
            $persona->update();
            DB::commit();
        }
        catch (Exception $e) {
            $resultado  = false;
            DB::rollback();
        }

        return response()->json([
            'resultado' => $resultado,
        ]);
        
    }

}
