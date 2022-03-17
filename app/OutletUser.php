<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OutletUser extends Model
{
    use HasFactory;
    protected $fillable =[
         "user_id", "outlet_id", "is_default","is_active"
    ];
}
