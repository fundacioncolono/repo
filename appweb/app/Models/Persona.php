<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model{

	public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = 'cedula';

    protected $fillable = [
        'cedula', 
        'nombre', 
        'apellidos', 
        'telefonos',
        'ubicacion',
        'direccion',
        'contactos',
    ];

    public function expediente(){
        return $this->hasOne('App\Models\Expediente','persona_fk');
    }

}
