<?php

use Illuminate\Database\Seeder;

class AyudasSeeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('ayudas')->insert([
            ['descripcion' => 'Alimentación'],
            ['descripcion' => 'Construcción'],
            ['descripcion' => 'Medicamentos'],
            ['descripcion' => 'Equipo Médico'],
            ['descripcion' => 'Aporte Económico'],
        ]);
    }
}
