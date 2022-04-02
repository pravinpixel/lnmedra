<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('sale_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('payment_id');
            $table->string('payment_reference');
            $table->string('change');
            $table->double('amount');
            $table->string('paying_method');
            $table->text('payment_note')->nullable();
            $table->foreign('customer_id')->references('id')->on('customers');
            $table->foreign('payment_id')->references('payments');
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
        Schema::dropIfExists('payments');
    }
}
