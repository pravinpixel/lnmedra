<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorProductss extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            $table->string('ln_price')->nullable();
            $table->string('ln_qty')->nullable();
            $table->string('discount')->nullable();
            $table->string('attribute')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vendor_products', function (Blueprint $table) {
            //
        });
    }
}
