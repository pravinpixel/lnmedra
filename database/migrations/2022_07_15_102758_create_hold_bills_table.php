<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHoldBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hold_bills', function (Blueprint $table) {
            $table->id();
            $table->longText("tbody_id")->nullable();
            $table->string("customer_id")->nullable();
            $table->string("customer_name")->nullable();
            $table->string("user_id")->nullable();
            $table->string("hold_bill_no")->nullable();
            $table->longText("localStorageProductCode")->nullable();
            $table->string("discount_method")->nullable();
            $table->string("order_discount")->nullable();
            $table->string("shipping_cost_val")->nullable();
            $table->string("order_tax_rate_select")->nullable();
            $table->string("localStorageSaleUnit")->nullable();
            $table->string("localStorageTaxMethod")->nullable();
            $table->string("localStorageTaxRate")->nullable();
            $table->string("localStorageTaxValue")->nullable();
            $table->longText("localStorageTempUnitName")->nullable();
            $table->string("localStorageSubTotal")->nullable();
            $table->string("localStorageQty")->nullable();
            $table->string("localStorageTaxName")->nullable();
            $table->string("localStorageSaleUnitOperationValue")->nullable();
            $table->string("localStorageSaleUnitOperator")->nullable();
            $table->string("localStorageProductDiscount")->nullable();
            $table->string("localStorageProductId")->nullable();
            $table->string("localStorageNetUnitPrice")->nullable();
            $table->string("localStorageSubTotalUnit")->nullable();
            $table->boolean("is_active")->default(1);
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
        Schema::dropIfExists('hold_bills');
    }
}
