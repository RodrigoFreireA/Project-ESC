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
        $table->dropColumn('dias');
    });
}

public function down()
{
    Schema::table('escalas', function (Blueprint $table) {
        $table->string('dias')->nullable();
    });
}
};
