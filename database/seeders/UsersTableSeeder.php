<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'password' => '$2y$10$DWAHTfjcvwCpOCXaJg11MOhsqns03uvlwiSUOQwkHL2YYrtrXPcL6',
                'vendor_id' => NULL,
                'remember_token' => 'PCJ94RmpuxYqcqkcsbDOx2UluXGVa25IXiIPLmUbqo0ANJ7YxUaQTlphLTCv',
                'created_at' => '2018-06-02 08:54:15',
                'updated_at' => '2022-02-10 17:54:13',
                'phone' => '12112',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => NULL,
                'company_name' => 'Bugs & Bees',
                'role_id' => 1,
                'biller_id' => NULL,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => 0,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'vendor',
                'email' => 'vendor@gmail.com.com',
                'password' => '$2y$10$w.b2bzWwbCP1Ud41QSfRAuzL7NTu3s0i.ZWIN6fi6Qwm5UhnhmYeq',
                'vendor_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-04 15:59:03',
                'updated_at' => '2022-03-17 17:51:20',
                'phone' => '7741111111',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => '2022-03-17',
                'company_name' => 'Bugs & Bees',
                'role_id' => 6,
                'biller_id' => 5,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => 0,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ceo',
                'email' => 'ceo@gmail.com',
                'password' => '$2y$10$xBCbRNEwKRSsNKLm/tATgORabSJXjqNzSXxdMlUNGPgd0Fu0umOPG',
                'vendor_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-17 17:47:09',
                'updated_at' => '2022-03-25 11:54:25',
                'phone' => '+1 (572) 487-8275',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => '1986-08-05',
                'company_name' => 'Bugs & Bees',
                'role_id' => 2,
                'biller_id' => 1,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => 0,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'staff',
                'email' => 'staff@gmail.com',
                'password' => '$2y$10$WXaUbJVOrxQ985lWEtVLY.1Kib9dq/cvXrGuIzlKj7an9YDXj1V2i',
                'vendor_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-17 17:49:21',
                'updated_at' => '2022-03-17 17:49:21',
                'phone' => '+1 (274) 945-94971',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => '2022-03-17',
                'company_name' => 'Bugs & Bees',
                'role_id' => 3,
                'biller_id' => 2,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => 0,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Super Admin',
                'email' => 'superadmin@gmail.com',
                'password' => '$2y$10$cKTQpbfb5MCJhRioP6X8Z.PDiwv8Q/3cSCUL1djxxHAwhlnOPX11C',
                'vendor_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-18 15:41:08',
                'updated_at' => '2022-03-18 15:41:09',
                'phone' => '7894561230',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => '2022-03-18',
                'company_name' => 'Bugs & Bees',
                'role_id' => 7,
                'biller_id' => 1,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => 0,
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Ajith',
                'email' => 'ajith@gmail.com',
                'password' => '$2y$10$8twRAjM5sbuI7cDIigUT/OWbsMhdxHjCyRh0gyGr2ZcjlFPVSC6yS',
                'vendor_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-18 16:39:07',
                'updated_at' => '2022-03-18 16:39:07',
                'phone' => '7894561230',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => NULL,
                'company_name' => 'Bugs & Bees',
                'role_id' => 6,
                'biller_id' => NULL,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'pravin',
                'email' => 'pravin@pixel-studios.com',
                'password' => '$2y$10$Cb40BC/iEQMFl4nDCsi8CuKXb.TKNXdyIzz61l0dJfG70ZXOwDdfi',
                'vendor_id' => NULL,
                'remember_token' => NULL,
                'created_at' => '2022-03-23 11:05:24',
                'updated_at' => '2022-03-23 11:05:24',
                'phone' => '9962520064',
                'address_proof' => NULL,
                'id_proof' => NULL,
                'join_date' => NULL,
                'company_name' => 'Bugs & Bees',
                'role_id' => 6,
                'biller_id' => NULL,
                'warehouse_id' => 1,
                'is_active' => 1,
                'is_deleted' => NULL,
            )
        ));
    }
}