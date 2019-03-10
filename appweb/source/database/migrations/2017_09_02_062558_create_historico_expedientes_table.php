<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHistoricoExpedientesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('historico_expedientes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('expediente_fk');
            $table->timestamp('fecha_modificacion')->nullable();

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
        Schema::dropIfExists('casos');
    }
}
