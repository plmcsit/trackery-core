<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddInfoOnTraininfoTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('TrainInfo');
        Schema::create('TrainInfo', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('location');
            $table->string('message')->nullable();
            $table->boolean('found');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('TrainInfo');
    }
}
