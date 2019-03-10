<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Visita extends Model
{    
	const CREATED_AT = 'fecha_asignado';
	public $timestamps = false;

    public function expediente(){
        return $this->belongsTo('App\Models\Expediente', 'expediente_fk');
    }
}
