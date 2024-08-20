<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEscalasTable extends Migration
{
    public function up()
    {
        Schema::create('escalas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funcionario_id')->constrained();
            $table->date('data');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->boolean('recorrente')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('escalas');
    }
}
