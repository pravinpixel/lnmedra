<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVendorProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendor_products', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('code');
            $table->string('type');
            $table->string('barcode_symbology')->nullable();
            $table->integer('brand_id')->nullable();
            $table->integer('category_id')->nullable();
            $table->integer('unit_id')->nullable();
            $table->integer('purchase_unit_id')->nullable();
            $table->integer('sale_unit_id')->nullable();
            $table->string('cost')->nullable();
            $table->string('price')->nullable();
            $table->double('qty')->nullable();
            $table->double('alert_quantity')->nullable();
            $table->tinyInteger('promotion')->nullable();
            $table->string('promotion_price')->nullable();
            $table->date('starting_date')->nullable();
            $table->date('last_date')->nullable();
            $table->integer('tax_id')->nullable();
            $table->integer('tax_method')->nullable();
            $table->longText('image')->nullable();
            $table->tinyInteger('featured')->nullable();
            $table->text('product_details')->nullable();
            $table->boolean('is_active')->nullable();
            $table->integer('vendoruserid')->nullable();
            
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
        Schema::dropIfExists('products');
    }
}
