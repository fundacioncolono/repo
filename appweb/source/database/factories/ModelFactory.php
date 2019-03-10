<?php

/*
|--------------------------------------------------------------------------
| Persona Factory
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Persona::class, function (Faker\Generator $faker) {

    $tels = "$faker->tollFreephoneNumber";
    $randomNumbers = $faker->numberBetween(0,2);

    for($i = 0; $i < $randomNumbers; $i++){
        $tels .= ", $faker->tollFreephoneNumber";
    }

    return [
        'cedula'=>$faker->randomNumber(9,true),
        'nombre'=>$faker->firstname,
        'apellidos'=>"{$faker->lastname} {$faker->lastname}",
        'ocupacion'=>$faker->jobTitle,
        'telefonos'=>$tels,
        'ubicacion'=>'7/2/1',
        'direccion'=>$faker->address,
        'contactos'=>$faker->text(100)
    ];
});

/*
|--------------------------------------------------------------------------
| Referente Factory
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Referente::class, function (Faker\Generator $faker) {
	return ['descripcion' => $faker->boolean ? $faker->company : "{$faker->firstName} {$faker->lastname}"];
});


/*
|--------------------------------------------------------------------------
| Expediente Factory
|--------------------------------------------------------------------------
*/
$factory->define(App\Models\Expediente::class, function (Faker\Generator $faker) {
	$hasReferente     = $faker->boolean;
	$referentes       = App\Models\Referente::all();
	$referente_otro   = $referentes[0];
	$referentes_count = count($referentes);
	$estado           = $faker->numberBetween(0,3);
	$tmp_meses = $faker->numberBetween(-12, 12);
	$fecha_desde = new \DateTime();
	$fecha_desde->modify(($tmp_meses >= 0 ? '+' : '') . " $tmp_meses months");

    return [
		'referente_otro'    => $hasReferente ? null : ($faker->boolean? $faker->company: "{$faker->firstName} {$faker->lastname}"),
		'referente_fk'	    => $hasReferente ? $referentes[$faker->numberBetween(1, $referentes_count - 1)]->id: $referente_otro->id,
        'descripcion' 		=> $faker->text(500),
		'persona_fk'        => function(){ return factory(App\Models\Persona::class)->create()->cedula; },
        'prioridad'   		=> $faker->numberBetween(1,3),
		'estado'            => $estado,
		'entrega_inicio'    => $estado === 1 ? $faker->numberBetween(1,15) : null,
		'entrega_final'     => $estado === 1 ? $faker->numberBetween(16,30) : null,
		'fecha_desde'       => $estado === 1 ? $fecha_desde : null,
		'fecha_hasta'       => $estado === 1 ? $faker->dateTimeInInterval($fecha_desde, '+ 12 months') : null,
    ];
});
