<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[

        "name","mobile", "email","requirement","is_active"
    ];

}
