<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('roles')->delete();
        
        \DB::table('roles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Outlet Manager',
                'description' => 'Outlet Manager can access all data...',
                'is_active' => 1,
                'created_at' => '2018-06-02 05:16:44',
                'updated_at' => '2022-03-18 17:23:48',
                'guard_name' => 'web',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'CEO',
                'description' => 'CEO of company...',
                'is_active' => 1,
                'created_at' => '2018-10-22 08:08:13',
                'updated_at' => '2022-03-18 17:23:57',
                'guard_name' => 'web',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'staff',
                'description' => 'POS Billing',
                'is_active' => 1,
                'created_at' => '2018-06-02 05:35:27',
                'updated_at' => '2022-03-18 17:24:21',
                'guard_name' => 'web',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Customer',
                'description' => NULL,
                'is_active' => 0,
                'created_at' => '2020-11-05 12:13:16',
                'updated_at' => '2022-03-18 17:24:29',
                'guard_name' => 'web',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Developer',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
                'guard_name' => 'web',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Vendor',
                'description' => 'Product / PO',
                'is_active' => 1,
                'created_at' => '2022-03-04 15:27:31',
                'updated_at' => '2022-03-18 17:24:48',
                'guard_name' => 'web',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Super Admin',
                'description' => NULL,
                'is_active' => 1,
                'created_at' => '2022-03-18 15:34:17',
                'updated_at' => '2022-03-18 15:34:17',
                'guard_name' => 'web',
            ),
        ));
        
        
    }
}