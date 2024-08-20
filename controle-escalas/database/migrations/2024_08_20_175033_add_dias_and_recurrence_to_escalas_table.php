<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDiasAndRecurrenceToEscalasTable extends Migration
{
    public function up()
    {
        Schema::table('escalas', function (Blueprint $table) {
            $table->boolean('recorrente')->default(false); // Indica se a escala é recorrente
            $table->text('dias')->nullable(); // Armazena os dias (se aplicável)
        });
    }

    public function down()
    {
        Schema::table('escalas', function (Blueprint $table) {
            $table->dropColumn(['recorrente', 'dias']);
        });
    }
}
