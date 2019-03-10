<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visitas', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('inspector_fk');
            $table->unsignedInteger('expediente_fk');

            // Fecha en la que el inspector eligió la visita
            // $table->date('fecha_seleccion')->nullable();
            // Fecha en la que se da por concluida la visita
            $table->date('fecha_visita')->nullable();
            $table->timestamp('fecha_asignado')->useCurrent();
            
            $table->text('observaciones')->nullable();

            // Soft delete for inspector
            // Documentation at: https://laravel.com/docs/5.5/eloquent#soft-deleting
            $table->foreign('inspector_fk')
                  ->references('id')->on('inspectores')
                  ->onDelete('no action');

            $table->foreign('expediente_fk')
                  ->references('id')->on('expedientes')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visitas');
    }
}
