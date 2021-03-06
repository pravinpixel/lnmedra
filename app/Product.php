<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable =[
        "name", "code", "type","max_discount","markup","size","common_name","family_name","sku","attribute", "barcode_symbology", "vendor_product_id","vendor_user_id","brand_id", "category_id","unit_id", "purchase_unit_id", "sale_unit_id", "cost", "price", "qty", "alert_quantity", "promotion", "promotion_price", "starting_date", "last_date", "tax_id", "tax_method", "image", "file", "is_batch", "is_variant", "is_diffPrice", "is_imei", "featured", "product_list", "variant_list", "qty_list", "price_list", "product_details", "is_active"
    ];

    public function category()
    {
    	return $this->belongsTo('App\Category');
    }

    public function brand()
    {
    	return $this->belongsTo('App\Brand');
    }

    public function unit()
    {
        return $this->belongsTo('App\Unit');
    }

    public function variant()
    {
        return $this->belongsToMany('App\Variant', 'product_variants')->withPivot('id', 'item_code', 'additional_price');
    }

    public function scopeActiveStandard($query)
    {
        return $query->where([
            ['is_active', true]
          
        ]);
    }

    public function scopeActiveFeatured($query)
    {
        return $query->where([
            ['is_active', true],
            ['featured', 1],
            ['qty','>',0]
        ]);
    }

    public function vendorProduct()
    {
        return $this->hasOne(VendorProduct::class,'product_id','id');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class,'type','id');
    }
}
