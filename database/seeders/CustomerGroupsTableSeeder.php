<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;


class CustomerGroupsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customer_groups')->delete();
        
        \DB::table('customer_groups')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'general',
                'percentage' => '0',
                'is_active' => 1,
                'created_at' => '2018-05-12 13:39:36',
                'updated_at' => '2019-03-02 11:31:35',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'distributor',
                'percentage' => '-10',
                'is_active' => 1,
                'created_at' => '2018-05-12 13:42:14',
                'updated_at' => '2019-03-02 11:32:12',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'reseller',
                'percentage' => '5',
                'is_active' => 1,
                'created_at' => '2018-05-12 13:42:26',
                'updated_at' => '2018-05-30 06:48:14',
            )
        ));
        
        
    }
}