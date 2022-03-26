<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountsDate extends Model
{
    use HasFactory;
    protected $fillable =[

        "accounts_date_name", "percentage", "is_active","description"
    ];
}
