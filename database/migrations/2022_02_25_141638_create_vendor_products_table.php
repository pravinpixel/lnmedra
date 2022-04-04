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
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('created_by');
            $table->integer('qty');
            $table->decimal('price');
            $table->boolean('is_active')->default(1);
            $table->softDeletes('deleted_at');
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
