<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotacaoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotacao', function (Blueprint $table) {
            $table->id();

            $table->string('cep_origem', 9);
            $table->string('logradouro_origem');
            $table->string('cidade_origem', 50);
            $table->string('estado_origem', 2);

            $table->string('cep_destino', 9);
            $table->string('logradouro_destino');
            $table->string('cidade_destino', 50);
            $table->string('estado_destino', 2);

            //endereço origem e destino
            //cidade origem e destino

            $table->decimal('valor_total');
            $table->decimal('peso_total');
            $table->decimal('valor_cotacao');
            $table->decimal('prazo_coleta');
            $table->decimal('prazo_entrega');

            $table->text('requisicao');

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
        Schema::dropIfExists('cotacao');
    }
}
