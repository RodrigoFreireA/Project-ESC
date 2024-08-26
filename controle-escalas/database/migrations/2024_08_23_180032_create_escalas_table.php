<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('escalas', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->unsignedBigInteger('funcionario_id');
        $table->time('horario_inicio');
        $table->time('horario_fim');
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();
        $table->tinyInteger('recorrente')->default(0);
        $table->text('data')->nullable();
        $table->string('data_id', 191)->index();
        $table->text('observacoes')->nullable();

        // Defina o relacionamento com a tabela funcionarios
        $table->foreign('funcionario_id')->references('id')->on('funcionarios')->onDelete('cascade');
    });
}

};
