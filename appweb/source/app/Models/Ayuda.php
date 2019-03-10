<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ayuda extends Model
{
	protected $fillable = ['descripcion'];
	public $timestamps = false;
    
    public function transacciones()
    {
        return $this->hasManyThrough('App\Models\Transaccion', 'App\Models\AyudaExpediente', 'ayuda_fk', 'ayuda_expediente_fk');
    }

}
