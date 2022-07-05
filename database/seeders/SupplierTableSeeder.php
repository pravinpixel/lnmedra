<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('suppliers')->delete();

        \DB::table('suppliers')->insert(array(
            0 =>
            array(
                'id' => '1',
                'name' => 'vendor',
                'gst' => 'gst',
                'category' => '["1"]',
                'image' => NULL,
                'company_name' => 'vendor',
                'vat_number' => '0001',
                'email' => 'vendor@gmail.com',
                'password' => '$2y$10$w.b2bzWwbCP1Ud41QSfRAuzL7NTu3s0i.ZWIN6fi6Qwm5UhnhmYeq',
                'phone_number' => '1234567890',
                'address' => 'address',
                'city' => 'chennai',
                'state' => 'Tamil nadu',
                'postal_code' => '607641',
                'country' => 'India',
                'branch' => NULL,
                'account_no' => NULL,
                'ifs_code' => NULL,
                'bank_name' => 'Test',
                'entity_name' => '1234567898',
                'contact_person' => 'vendor1',
                'is_active' => 1,
                'created_at' => '2018-06-02 08:54:15',
                'updated_at' => '2022-02-10 17:54:13',

            ),

        ));
    }
}
