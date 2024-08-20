<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEscalasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('escalas', function (Blueprint $table) {
            // Adiciona uma coluna para marcar se a escala é recorrente
            $table->boolean('recorrente')->default(false);

            // Adiciona uma coluna para armazenar os dias recorrentes
            $table->text('dias')->nullable()->after('horario_fim');

            // Remove a coluna de data, pois será substituída por dias recorrentes
            $table->dropColumn('data');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('escalas', function (Blueprint $table) {
            // Reverte as alterações feitas no método up
            $table->dropColumn('recorrente');
            $table->dropColumn('dias');
            $table->date('data')->nullable()->after('funcionario_id');
        });
    }
}
