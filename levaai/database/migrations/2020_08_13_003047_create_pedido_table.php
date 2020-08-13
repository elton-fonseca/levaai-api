<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePedidoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pedido', function (Blueprint $table) {
            $table->id();

            $table->integer('status');
            $table->integer('pagamento_liberado');

            $table->string('responsavel_coleta');
            $table->string('responsavel_coleta_celular');
            $table->string('responsavel_entrega');
            $table->string('responsavel_entrega_calular');

            $table->unsignedBigInteger('cotacao_id');
            $table->foreign('cotacao_id')->references('id')->on('cotacao');

            $table->unsignedBigInteger('pagamento_id');
            $table->foreign('pagamento_id')->references('id')->on('pagamento');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pedido');
    }
}
