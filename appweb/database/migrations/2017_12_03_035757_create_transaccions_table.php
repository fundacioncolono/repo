<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransaccionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transacciones', function (Blueprint $table) {
            $table->increments('id');          
            
            $table->unsignedInteger('ayuda_expediente_fk');
            $table->unsignedInteger('usuario_fk');

            $table->text('detalle')
                  ->nullable()
                  ->default(null);

            $table->decimal('monto');

            $table->timestamp('fecha_creacion')->useCurrent();

            //* Define constraints -------------------------
            //*---------------------------------------------
            $table->foreign('ayuda_expediente_fk')
                  ->references('id')->on('ayuda_expedientes')
                  ->onDelete('no action');

            $table->foreign('usuario_fk')
                  ->references('id')->on('usuarios')
                  ->onDelete('no action');
            //*---------------------------------------------
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transacciones');
    }
}
