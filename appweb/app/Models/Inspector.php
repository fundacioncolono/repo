<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inspector extends Model{

    //use SoftDeletes;    
    //const DELETED_AT = 'fecha_eliminacion';

    public $timestamps = false;
    protected $table = 'inspectores';

    public function persona(){
        return $this->belongsTo('App\Models\Persona', 'persona_fk');
    }

    public function usuario(){
        return $this->belongsTo('App\Models\Usuario', 'usuario_fk');
    }

    public function visitas(){
        return $this->hasMany('App\Models\Visita', 'inspector_fk');
    }
}
