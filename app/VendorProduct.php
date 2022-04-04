<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorProduct extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'is_approve',
        'in_price',
        'in_qty',
        'discount',
        'attribute',
        'created_by',
    ];
}
