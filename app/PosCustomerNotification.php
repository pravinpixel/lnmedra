<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PosCustomerNotification extends Model
{
    use HasFactory,SoftDeletes;
    protected $fillable =[
        "sale_id", "customer_id", "file_path", "is_active"
    ];
}
