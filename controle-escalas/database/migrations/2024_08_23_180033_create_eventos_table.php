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
    Schema::create('eventos', function (Blueprint $table) {
        $table->bigIncrements('id');
        $table->string('nome', 191);
        $table->text('descricao')->nullable();
        $table->string('data_id', 191);
        $table->timestamp('created_at')->nullable();
        $table->timestamp('updated_at')->nullable();

        // Defina o relacionamento com a tabela escalas
        $table->foreign('data_id')->references('data_id')->on('escalas')->onDelete('cascade');
    });
}

};
