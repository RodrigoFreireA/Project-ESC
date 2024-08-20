<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateFuncionariosTable extends Migration
{
    public function up()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            // Remover colunas antigas
            $table->dropColumn(['data_trabalho', 'trabalhando']);
            
            // Adicionar novas colunas
            $table->string('localizacao');  // Cidade/Estado
            $table->string('unidade_atendida'); // Unidade atendida
        });
    }

    public function down()
    {
        Schema::table('funcionarios', function (Blueprint $table) {
            // Reverter mudanças
            $table->date('data_trabalho')->nullable();
            $table->boolean('trabalhando')->default(false);

            $table->dropColumn(['localizacao', 'unidade_atendida']);
        });
    }
}
