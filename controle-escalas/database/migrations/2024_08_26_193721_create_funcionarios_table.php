<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFuncionariosTable extends Migration
{
    public function up()
    {
        Schema::create('funcionarios', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 191);
            $table->enum('tipo_escala', ['diarista', '12x36']);
            $table->timestamps();
            $table->string('localizacao', 191);
            $table->string('unidade_atendida', 191);
        });
    }

    public function down()
    {
        Schema::dropIfExists('funcionarios');
    }
}
