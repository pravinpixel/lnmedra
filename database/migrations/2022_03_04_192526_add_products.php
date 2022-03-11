<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProducts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->integer('vendor_product_id')->after('barcode_symbology')->nullable();
            $table->string('sku')->after('type')->nullable();
            $table->string('family_name')->after('type')->nullable();
            $table->string('common_name')->after('type')->nullable();
            $table->string('size')->after('type')->nullable();
            $table->string('markup')->after('type')->nullable();
            $table->string('max_discount')->after('type')->nullable();
            $table->string('attribute')->after('type')->nullable();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            //
        });
    }
}
