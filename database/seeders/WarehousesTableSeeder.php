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
                'name' => 'warehouse 1',
                'phone' => '2312121',
                'email' => 'war1@lion.com',
                'address' => 'khatungonj, chittagong',
                'is_active' => 1,
                'created_at' => '2018-05-12 13:21:44',
                'updated_at' => '2019-03-02 21:10:17',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'warehouse 2',
                'phone' => '1234',
                'email' => NULL,
                'address' => 'boropul, chittagong',
                'is_active' => 1,
                'created_at' => '2018-05-12 13:39:03',
                'updated_at' => '2018-06-20 04:00:38',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'test',
                'phone' => NULL,
                'email' => NULL,
                'address' => 'dqwdeqw',
                'is_active' => 0,
                'created_at' => '2018-05-30 05:44:23',
                'updated_at' => '2018-05-30 05:44:47',
            ),
            3 => 
            array (
                'id' => 6,
                'name' => 'gudam',
                'phone' => '2121',
                'email' => '',
                'address' => 'gazipur',
                'is_active' => 0,
                'created_at' => '2018-09-01 04:23:26',
                'updated_at' => '2018-09-01 04:24:48',
            ),
        ));
        
        
    }
}