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
            $table->unsignedBigInteger('funcionario_id');
            $table->time('horario_inicio');
            $table->time('horario_fim');
            $table->timestamps();
            $table->tinyInteger('recorrente')->default(0);
            $table->text('data');
            $table->string('data_id', 191)->nullable();
            $table->text('observacoes')->nullable();
            $table->index('data_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('escalas');
    }
}
