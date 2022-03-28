<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WarehousesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('warehouses')->delete();
        
        \DB::table('warehouses')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Alwarpet',
                'phone' => '1234567890',
                'email' => 'alwarpet@lnmedra.com',
                'address' => 'Alwarpet, Chennai, 600018',
                'is_active' => 1,
                'created_at' => '2018-05-12 13:21:44',
                'updated_at' => '2019-03-02 21:10:17',
            ),
        ));
        
        
    }
}