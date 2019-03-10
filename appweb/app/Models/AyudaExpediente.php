<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class AyudaExpediente extends Pivot
{

	protected $table = 'ayuda_expedientes';
	
	public function ayuda()
	{
		return $this->belongsTo('App\Models\Ayuda', 'ayuda_fk');
	}

	public function expediente()
	{
		return $this->belongsTo('App\Models\Expediente', 'expediente_fk');
	}

}
