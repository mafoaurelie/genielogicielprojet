<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentTable extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('buyer_id')->unsigned();
            $table->integer('number_of_item');
            $table->integer('city_id')->unsigned();
            $table->integer('amount');
            $table->string('address');

            $table->foreign('buyer_id')
                 ->references('id')
                 ->on('users');
            $table->foreign('city_id')
                 ->references('id')
                 ->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('payment');
    }
}
