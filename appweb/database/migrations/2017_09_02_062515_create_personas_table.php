<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personas', function (Blueprint $table) {
            $table->char('cedula',9)->primary();
            $table->string('nombre', 50);
            $table->string('apellidos', 100);
            $table->string('ocupacion', 100)->nullable();
            $table->text('telefonos',150)->nullable();
            $table->char('ubicacion',6);
            $table->text('direccion',150)->nullable();
            $table->text('contactos',150)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('personas');
    }
}
