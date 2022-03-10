<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterAttribute extends Model
{
    use HasFactory;
    protected $fillable =[
        "title", "image", "product_type","shorting","is_active",
    ];

}
