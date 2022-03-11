<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('units')->delete();
        
        \DB::table('units')->insert(array (
            0 => 
            array (
                'id' => 1,
                'unit_code' => 'pc',
                'unit_name' => 'Piece',
                'base_unit' => NULL,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 07:57:46',
                'updated_at' => '2018-08-18 03:11:53',
            ),
            1 => 
            array (
                'id' => 2,
                'unit_code' => 'dozen',
                'unit_name' => 'dozen box',
                'base_unit' => 1,
                'operator' => '*',
                'operation_value' => 12.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 15:27:05',
                'updated_at' => '2018-05-12 15:27:05',
            ),
            2 => 
            array (
                'id' => 3,
                'unit_code' => 'cartoon',
                'unit_name' => 'cartoon box',
                'base_unit' => 1,
                'operator' => '*',
                'operation_value' => 24.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 15:27:45',
                'updated_at' => '2020-03-11 16:06:59',
            ),
            3 => 
            array (
                'id' => 4,
                'unit_code' => 'm',
                'unit_name' => 'meter',
                'base_unit' => NULL,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 15:28:07',
                'updated_at' => '2018-05-28 04:50:57',
            ),
            4 => 
            array (
                'id' => 6,
                'unit_code' => 'test',
                'unit_name' => 'test',
                'base_unit' => NULL,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 0,
                'created_at' => '2018-05-28 04:50:20',
                'updated_at' => '2018-05-28 04:50:25',
            ),
            5 => 
            array (
                'id' => 7,
                'unit_code' => 'kg',
                'unit_name' => 'kilogram',
                'base_unit' => NULL,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 1,
                'created_at' => '2018-06-25 06:19:26',
                'updated_at' => '2018-06-25 06:19:26',
            ),
            6 => 
            array (
                'id' => 8,
                'unit_code' => '20',
                'unit_name' => 'ni33',
                'base_unit' => 8,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 0,
                'created_at' => '2018-08-01 04:05:51',
                'updated_at' => '2018-08-01 04:10:54',
            ),
            7 => 
            array (
                'id' => 9,
                'unit_code' => 'gm',
                'unit_name' => 'gram',
                'base_unit' => 7,
                'operator' => '/',
                'operation_value' => 1000.0,
                'is_active' => 1,
                'created_at' => '2018-09-01 05:36:28',
                'updated_at' => '2018-09-01 05:36:28',
            ),
            8 => 
            array (
                'id' => 10,
                'unit_code' => 'gz',
                'unit_name' => 'goz',
                'base_unit' => NULL,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 0,
                'created_at' => '2018-11-29 09:10:29',
                'updated_at' => '2019-03-02 17:23:29',
            ),
        ));
        
        
    }
}