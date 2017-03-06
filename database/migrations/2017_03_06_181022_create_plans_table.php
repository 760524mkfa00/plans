<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('building_id')->unsigned();
            $table->integer('floor_id')->unsigned();
            $table->integer('type_id')->unsigned();
            $table->string('name');
            $table->string('path');
            $table->string('file_type');
            $table->timestamps();

            $table->foreign('building_id')->references('id')->on('buildings');
            $table->foreign('floor_id')->references('id')->on('floors');
            $table->foreign('type_id')->references('id')->on('types');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plans');
    }
}
