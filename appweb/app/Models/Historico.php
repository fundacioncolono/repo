<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Historico extends Model{
    
    const CREATED_AT = 'fecha_modificacion';

    protected $table = 'historico_expedientes';

    public $timestamps = false;

    public function expediente(){
        return $this->belongsTo('App\Models\Expediente', 'expediente_fk')->onlyTrashed();
    }

}
