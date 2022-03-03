<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnquiryMailAttachment extends Model
{
    use HasFactory;
    protected $fillable =[
        "enquiry_id","enquiry_email", "bcc","cc","mail_content","attachment","is_active"
    ];
}
