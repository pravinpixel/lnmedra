<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PosSettingTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('pos_setting')->delete();
        
        \DB::table('pos_setting')->insert(array (
            0 => 
            array (
                'id' => 1,
                'customer_id' => 11,
                'warehouse_id' => 1,
                'biller_id' => 1,
                'supplier_id' => 8,
                'product_number' => 4,
                'keybord_active' => 0,
                'stripe_public_key' => NULL,
                'stripe_secret_key' => '',
                'created_at' => '2018-09-02 08:47:04',
                'updated_at' => '2020-04-17 19:29:54',
            ),
        ));
        
        
    }
}