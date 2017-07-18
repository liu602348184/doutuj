<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFaceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('face', function (Blueprint $table) {
            $table->increments('id');
            $table->string('path');
            $table->integer('navid');
            $table->integer('sort')->nullable();
            $table->string('desc')->nullable();
            $table->string('title')->nullable();
            
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
        Schema::dropIfExists('face');
    }
}
