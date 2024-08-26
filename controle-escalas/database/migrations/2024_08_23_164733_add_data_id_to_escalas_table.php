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
    Schema::table('escalas', function (Blueprint $table) {
        $table->unsignedBigInteger('data_id')->nullable();
        $table->foreign('data_id')->references('id')->on('datas');
    });
}

public function down()
{
    Schema::table('escalas', function (Blueprint $table) {
        $table->dropForeign(['data_id']);
        $table->dropColumn('data_id');
    });
}

};
