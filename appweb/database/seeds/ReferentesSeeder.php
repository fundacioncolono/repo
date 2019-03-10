<?php

use Illuminate\Database\Seeder;

class ReferentesSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
		if (App\Models\Referente::count() === 0)
			App\Models\Referente::create(['descripcion' => 'Otro']);
			
        factory(App\Models\Referente::class, 20)->create();
    }
}
