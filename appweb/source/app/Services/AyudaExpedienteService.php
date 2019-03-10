<?php

namespace App\Services;

class AyudaExpedienteService{
	
	public static function attach($ayudas, $attachs, $withPivot = false){
		for ($i=0, $count = count($attachs); $i < $count; $i++)
            $ayudas->attach(
                $attachs[$i]['id'],
				[
					'detalle' => $withPivot ? $attachs[$i]['pivot']['detalle'] : $attachs[$i]['detalle'],
					'monto'   => $withPivot ? $attachs[$i]['pivot']['monto']   : $attachs[$i]['monto']
				]
			);
	}
	
	public static function detach($ayudas, $detachs){
		$ayudas->detach(collect($detachs)->map(function ($item) { return $item['id']; }));
	}
			
			
	public static function update($ayudas, $updates){
		for ($i=0, $count = count($updates); $i < $count; $i++)
			$ayudas->updateExistingPivot(
				$updates[$i]['id'],
				[
					'detalle' => $updates[$i]['pivot']['detalle'],
					'monto'   => $updates[$i]['pivot']['monto']
				]
			);
	}

}
