<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expediente extends Model{

	use SoftDeletes;

	const CREATED_AT = 'fecha_creacion';
	const DELETED_AT = 'fecha_eliminacion';
	
	protected $dates = ['fecha_eliminacion'];
	protected $fillable = [
        'referente_otro',
		'descripcion', 
		'fecha_desde', 
		'fecha_hasta',
		'entrega_inicio', 
		'entrega_final', 
		'prioridad', 
		'estado', 
	];

	public $timestamps = false;

	//* Relationships	----------------//
	public function persona(){
		return $this->belongsTo('App\Models\Persona', 'persona_fk');
	}

	public function referente(){
		return $this->belongsTo('App\Models\Referente', 'referente_fk');
	}

	public function ayudas(){
		return $this->belongsToMany('App\Models\Ayuda', 'ayuda_expedientes', 'expediente_fk', 'ayuda_fk')->withPivot(['detalle','monto']);
	}

	public function transacciones(){
		return $this->hasManyThrough('App\Models\Transaccion', 'App\Models\AyudaExpediente', 'expediente_fk', 'ayuda_expediente_fk');
	}

	//* Mutators and Accessors ----------------------//
	public function getFechaCreacionAttribute($value){
		return (new \DateTime($value))->format('d-m-Y');
	}

	public function setFechaDesdeAttribute($value){		
        $this->attributes['fecha_desde'] = gettype($value) !== 'object' ? 
            (new \DateTime($value))->format('Y-m-d') :
            $value;
	}

	public function setFechaHastaAttribute($value){
        $this->attributes['fecha_hasta'] = gettype($value) !== 'object' ? 
            (new \DateTime($value))->format('Y-m-d') :
            $value;
	}

	//*	Getters	----------------------------//
	public function getMeses(){
		$diff = (new \DateTime($this->fecha_desde))->diff(new \DateTime($this->fecha_hasta), true); 
		return ($diff->m + 1) + ($diff->y * 11);
	}

	public function getMontoTotal(){
		$monto = 0;

		foreach ($this->ayudas as $a) { $monto += $a->pivot->monto; }

		return $monto;
	}

}
