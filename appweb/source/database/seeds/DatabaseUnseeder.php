<?php

use Illuminate\Database\Seeder;

class DatabaseUnseeder extends Seeder{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(){
        DB::table('personas')->delete();
        DB::table('ayudas')->delete();
		DB::table('referentes')->delete();
        DB::table('visitas')->delete();
        DB::table('historico_expedientes')->delete();
        DB::table('ayuda_expedientes')->delete();
    }
}
