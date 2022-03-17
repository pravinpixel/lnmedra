<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Test Product',
                'code' => '06837321',
                'type' => '1',
                'attribute' => '1',
                'max_discount' => '50',
                'markup' => '10',
                'size' => '84',
                'common_name' => 'sada',
                'family_name' => 'asdas',
                'sku' => 'dsa',
                'barcode_symbology' => 'C128',
                'vendor_product_id' => NULL,
                'brand_id' => 9,
                'category_id' => 29,
                'unit_id' => 1,
                'purchase_unit_id' => 2,
                'sale_unit_id' => 1,
                'cost' => '200',
                'price' => '250',
                'qty' => 0.0,
                'alert_quantity' => 25.0,
                'promotion' => NULL,
                'promotion_price' => NULL,
                'starting_date' => NULL,
                'last_date' => NULL,
                'tax_id' => NULL,
                'tax_method' => 1,
                'image' => '1647520908798depositphotos_77567310-stock-photo-female-hand-with-fertilizer-for.jpg',
                'file' => NULL,
                'is_variant' => NULL,
                'is_batch' => NULL,
                'is_diffPrice' => NULL,
                'is_imei' => NULL,
                'featured' => 1,
                'product_list' => NULL,
                'variant_list' => NULL,
                'qty_list' => NULL,
                'price_list' => NULL,
                'product_details' => '<p>qewqewrd</p>',
                'is_active' => 1,
                'created_at' => '2022-03-17 18:41:59',
                'updated_at' => '2022-03-17 18:55:29',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Sample Product',
                'code' => '33089282',
                'type' => '1',
                'attribute' => '1',
                'max_discount' => '10',
                'markup' => '10',
                'size' => '10',
                'common_name' => 'Test',
                'family_name' => 'Test',
                'sku' => 'kun',
                'barcode_symbology' => 'C128',
                'vendor_product_id' => NULL,
                'brand_id' => 9,
                'category_id' => 29,
                'unit_id' => 1,
                'purchase_unit_id' => 3,
                'sale_unit_id' => 2,
                'cost' => '200',
                'price' => '250',
                'qty' => 0.0,
                'alert_quantity' => 25.0,
                'promotion' => NULL,
                'promotion_price' => NULL,
                'starting_date' => '2022-03-17',
                'last_date' => NULL,
                'tax_id' => NULL,
                'tax_method' => 1,
                'image' => '16475216639441409190248781.jpeg',
                'file' => NULL,
                'is_variant' => NULL,
                'is_batch' => 1,
                'is_diffPrice' => NULL,
                'is_imei' => 1,
                'featured' => 1,
                'product_list' => NULL,
                'variant_list' => NULL,
                'qty_list' => NULL,
                'price_list' => NULL,
                'product_details' => '<p>Test</p>',
                'is_active' => 1,
                'created_at' => '2022-03-17 18:55:21',
                'updated_at' => '2022-03-17 18:55:21',
            ),
        ));
        
        
    }
}