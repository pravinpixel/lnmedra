<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => Str::random(),
            "code" => Str::random(), 
            "type"=> 1, 
            "max_discount" => 1, 
            "markup" => 1, 
            "size" => 1, 
            "common_name" => Str::random(),
            "family_name" => 'tree', 
            "sku" => '128', 
            "attribute" => '', 
            "barcode_symbology" => 'UPCE', 
            "vendor_product_id" => 1, 
            "vendor_user_id" => 1, 
            "brand_id" => 1, 
            "category_id" => 1, 
            "unit_id" => 1, 
            "purchase_unit_id" => 1, 
            "sale_unit_id" => 1, 
            "cost" => rand(2,50), 
            "price" => rand(2,50), 
            "qty" => rand(2,50), 
            "alert_quantity" => rand(2,50), 
            "promotion"=> '',  
            "promotion_price"=> '', 
            "starting_date" => now(), 
            "last_date"=> now(),
            "tax_id" => 1, 
            "tax_method"=> 1, 
            "image" => '202203240655282.jpg', 
            "file" => '', 
            "is_batch"=> '', 
            "is_variant"=> '', 
            "is_diffPrice"=> '', 
            "is_imei"=> '', 
            "featured" => 1, 
            "product_list"=> '', 
            "variant_list"=> '', 
            "qty_list"=> '', 
            "price_list"=> '', 
            "product_details"=> '',
             "is_active" => 1
        ];
    }
}
