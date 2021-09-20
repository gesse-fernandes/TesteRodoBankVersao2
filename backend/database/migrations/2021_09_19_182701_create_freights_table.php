<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFreightsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('freights', function (Blueprint $table) {
            //TODO meu id
            $table->id();
            //TODO a placa do veiculo precisa ser unique ja que só existe uma unica placa de veiculo nunca é a mesma não pode haver duplicada
            $table->string('board')->unique();
            //TODO coluna dono do veiculo
            $table->string('vehicle_owner');
            //TODO o valor do frete
            $table->decimal('price_freight', 10, 2);
            //TODO a data de inicio
            $table->date('date_start');
            //TODO a data de fim
            $table->date('date_end');
            //TODO status coloquei como enum pois vai ser 3 opções.
            $table->enum('status', ['Iniciado', 'em trânsito', 'concluído']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('freights');
    }
}
