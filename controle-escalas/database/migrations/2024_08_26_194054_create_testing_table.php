<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestingTable extends Migration
{
    public function up()
    {
        Schema::create('testing', function (Blueprint $table) {
            $table->integer('id');
            $table->primary('id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('testing');
    }
}
