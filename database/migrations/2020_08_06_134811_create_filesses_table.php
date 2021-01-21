<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilessesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('filesses', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('apartment_id')->unsigned();
            $table->string('path');
            $table->string('description');
            $table->timestamps();
            $table->foreign('apartment_id')
                  ->references('id')
                  ->on('appartements');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('filess');
    }
}
