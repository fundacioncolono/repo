<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaccion extends Model
{

    const CREATED_AT = 'fecha_creacion';

    public $timestamps = false;

	protected $table = 'transacciones';

    public function ayudaExpedientes()
	{
		return $this->belongsTo('App\Models\AyudaExpediente', 'ayuda_expediente_fk');
    }
}
