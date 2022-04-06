<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VendorProduct extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'is_approve',
        'in_price',
        'in_qty',
        'actual_qty',
        'discount',
        'attribute',
        'created_by',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
