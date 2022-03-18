<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddSuppliers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('suppliers', function (Blueprint $table) {
           
            $table->string('gst')->after('name')->nullable();
            $table->string('password')->after('email')->nullable();
            $table->string('contact_person')->after('country')->nullable();
            $table->string('entity_name')->after('country')->nullable();
            $table->string('bank_name')->after('country')->nullable();
            $table->string('ifs_code')->after('country')->nullable();
            $table->string('account_no')->after('country')->nullable();
            $table->string('branch')->after('country')->nullable();
           
            
           
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('suppliers', function (Blueprint $table) {
            //
        });
    }
}
