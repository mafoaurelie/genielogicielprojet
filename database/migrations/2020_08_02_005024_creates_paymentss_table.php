<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatesPaymentssTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('paymentss', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('buyer_id')->unsigned();
            $table->integer('number_of_item');
            $table->integer('apartment_id')->unsigned();
            $table->integer('amount');
            $table->string('address');

            $table->foreign('buyer_id')
                 ->references('id')
                 ->on('users');
            $table->foreign('apartment_id')
                 ->references('id')
                 ->on('appartements');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists('paymentsss');
    }
}
