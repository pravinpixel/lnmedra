<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCouponCodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('hold_bills', function (Blueprint $table) {
            $table->string('coupon_code')->after('order_discount')->nullable();
            $table->string('sales_person_code')->after('order_discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('hold_bills', function (Blueprint $table) {
            //
        });
    }
}
