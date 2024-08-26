<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventosTable extends Migration
{
    public function up()
    {
        Schema::create('eventos', function (Blueprint $table) {
            $table->id();
            $table->string('nome', 191);
            $table->text('descricao')->nullable();
            $table->string('data_id', 191);
            $table->timestamps();
            $table->foreign('data_id')->references('data_id')->on('escalas');
        });
    }

    public function down()
    {
        Schema::dropIfExists('eventos');
    }
}
