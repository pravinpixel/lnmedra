<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MailTemplate extends Model
{
    use HasFactory;
    protected $fillable =[
        "template_name","subject", "bcc","cc","mail_content","is_active"
    ];
}
