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
                'name' => 'Admin',
                'description' => 'admin can access all data...',
                'guard_name' => 'web',
                'is_active' => 1,
                'created_at' => '2018-06-02 05:16:44',
                'updated_at' => '2018-06-03 04:43:05',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Owner',
                'description' => 'Owner of shop...',
                'guard_name' => 'web',
                'is_active' => 1,
                'created_at' => '2018-10-22 08:08:13',
                'updated_at' => '2018-10-22 08:08:13',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'staff',
                'description' => 'staff has specific acess...',
                'guard_name' => 'web',
                'is_active' => 1,
                'created_at' => '2018-06-02 05:35:27',
                'updated_at' => '2018-06-02 05:35:27',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Customer',
                'description' => NULL,
                'guard_name' => 'web',
                'is_active' => 1,
                'created_at' => '2020-11-05 12:13:16',
                'updated_at' => '2020-11-15 05:54:15',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Vendor',
                'description' => NULL,
                'guard_name' => 'web',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Developer',
                'description' => 'Lorem iposium idasuie',
                'guard_name' => 'web',
                'is_active' => 0,
                'created_at' => '2022-03-04 15:27:31',
                'updated_at' => '2022-03-04 15:27:46',
            ),
        ));
        
        
    }
}