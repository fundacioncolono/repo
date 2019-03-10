<?php

use Illuminate\Database\Seeder;

class ExpedientesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
		$faker = Faker\Factory::create();

		$ayudas = App\Models\Ayuda::all();
		$ayudas_count = count($ayudas);

		factory(App\Models\Expediente::class, 60)->create()
		->each(function($expediente) use($faker, $ayudas, $ayudas_count) {

			//* Attach ayudas
			for ($i=0, $count = $faker->numberBetween(1, $ayudas_count); $i < $count; $i++) 
            $expediente->ayudas()->attach($ayudas[$faker->numberBetween(0, $ayudas_count - 1)]->id, ['detalle' => $faker->text(300), 'monto' => $faker->numberBetween(10000, 1000000)]);
        });
    }
}
