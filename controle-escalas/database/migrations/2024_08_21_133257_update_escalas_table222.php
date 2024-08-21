<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEscalasTableForFuncionarioId extends Migration
{
    public function up()
    {
        Schema::table('escalas', function (Blueprint $table) {
            $table->bigInteger('funcionario_id')->unsigned()->after('id');
            $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('escalas', function (Blueprint $table) {
            $table->dropForeign(['funcionario_id']);
            $table->dropColumn('funcionario_id');
        });
    }
}
