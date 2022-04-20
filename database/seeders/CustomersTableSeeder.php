<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
           
            0 => 
            array (
                'id' => 1,
                'customer_group_id' => 1,
                'user_id' => NULL,
                'name' => 'walk-in-customer',
                'full_name' => 'walk-in-customer',
                'company_name' => NULL,
                'email' => '',
                'phone_number' => '01923000001',
                'requirement' => NULL,
                'tax_no' => '11111',
                'address' => 'mohammadpur',
                'city' => 'dhaka',
                'state' => NULL,
                'remark' => NULL,
                'customer_marry_date' => NULL,
                'customer_dob' => NULL,
                'postal_code' => NULL,
                'country' => NULL,
                'points' => 468.0,
                'is_active' => 1,
                'created_at' => '2018-09-02 07:00:54',
                'updated_at' => '2022-03-26 12:52:20',
                'deposit' => NULL,
                'expense' => 0.0,
            )
        ));
        
        
    }
}