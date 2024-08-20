<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRecorrenteToEscalasTable extends Migration
{
    public function up()
    {
        Schema::table('escalas', function (Blueprint $table) {
            $table->boolean('recorrente')->default(false);
        });
    }

    public function down()
    {
        Schema::table('escalas', function (Blueprint $table) {
            $table->dropColumn('recorrente');
        });
    }
}
