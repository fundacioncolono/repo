<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInspectoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inspectores', function (Blueprint $table) {
            $table->increments('id');

            $table->char('persona_fk', 9);
            $table->unsignedInteger('usuario_fk');

            // constraints
            $table->foreign('persona_fk')
                  ->references('cedula')->on('personas')
                  ->onDelete('cascade');

            $table->foreign('usuario_fk')
                  ->references('id')->on('usuarios')
                  ->onDelete('cascade');

            $table->tinyInteger('activo')->default(1);
        
            //$table->softDeletes('fecha_eliminacion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inspectores');
    }
}
