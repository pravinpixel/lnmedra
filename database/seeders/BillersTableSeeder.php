<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BillersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('billers')->delete();
        
        \DB::table('billers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Bug & Bees',
                'image' => 'aks.jpg',
                'company_name' => 'Bug & Bees',
                'vat_number' => '12345',
                'email' => 'bugsnbees@lnmedra.com',
                'phone_number' => '442343324',
                'address' => 'Alwarpet',
                'city' => 'Chennai',
                'state' => 'Tamilnadu',
                'postal_code' => '600018',
                'country' => 'India',
                'is_active' => 1,
                'created_at' => '2018-05-13 03:19:30',
                'updated_at' => '2019-03-02 10:50:38',
            ),
        ));
        
        
    }
}