<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){

		//* If ayudas tables is empty, then call seeder
		if(App\Models\Ayuda::count() === 0) $this->call(AyudasSeeder::class);
		
		//* If referentes tables is empty, then call seeder
        if(App\Models\Referente::count() === 0) $this->call(ReferentesSeeder::class);

		//* Seed expedientes table
        $this->call(ExpedientesSeeder::class);
    }
}
