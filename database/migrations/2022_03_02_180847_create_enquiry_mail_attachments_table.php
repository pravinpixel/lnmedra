<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryMailAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_mail_attachments', function (Blueprint $table) {
            $table->id();
            $table->string('enquiry_id')->nullable();
            $table->string('enquiry_email')->nullable();
            $table->string('bcc')->nullable();
            $table->string('cc')->nullable();
            $table->longText('mail_content')->nullable();
            $table->string('attachment')->nullable();
            $table->string('is_active')->nullable();
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
        Schema::dropIfExists('enquiry_mail_attachments');
    }
}
