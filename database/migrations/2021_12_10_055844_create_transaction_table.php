<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransactionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaction', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('id_user');
            $table->string('transaction_code');
            $table->string('comment')->nullable();
            $table->string('name');
            $table->string('phone_number');
            $table->string('address');
            $table->string('amount');
            $table->string('payment')->nullable();
            $table->string('payment_info')->nullable();
            $table->dateTime('is_moving')->nullable();
            $table->bigInteger('id_receive')->nullable();
            $table->tinyInteger('is_cancel');
            $table->dateTime('is_receive')->nullable();
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
        Schema::dropIfExists('transaction');
    }
}
