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
                'name' => 'yousuf',
                'image' => 'aks.jpg',
                'company_name' => 'aks',
                'vat_number' => '31123',
                'email' => 'yousuf@kds.com',
                'phone_number' => '442343324',
                'address' => 'halishahar',
                'city' => 'chittagong',
                'state' => NULL,
                'postal_code' => NULL,
                'country' => 'sdgs',
                'is_active' => 1,
                'created_at' => '2018-05-13 03:19:30',
                'updated_at' => '2019-03-02 10:50:38',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'tariq',
                'image' => NULL,
                'company_name' => 'big tree',
                'vat_number' => NULL,
                'email' => 'tariq@bigtree.com',
                'phone_number' => '321312',
                'address' => 'khulshi',
                'city' => 'chittagong',
                'state' => NULL,
                'postal_code' => NULL,
                'country' => NULL,
                'is_active' => 1,
                'created_at' => '2018-05-13 03:27:54',
                'updated_at' => '2018-06-15 05:37:11',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'test',
                'image' => NULL,
                'company_name' => 'test',
                'vat_number' => NULL,
                'email' => 'test@test.com',
                'phone_number' => '3211',
                'address' => 'erewrwqre',
                'city' => 'afsf',
                'state' => NULL,
                'postal_code' => NULL,
                'country' => NULL,
                'is_active' => 0,
                'created_at' => '2018-05-30 08:08:58',
                'updated_at' => '2018-05-30 08:09:57',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'modon',
                'image' => 'mogaTel.jpg',
                'company_name' => 'mogaTel',
                'vat_number' => '',
                'email' => 'modon@gmail.com',
                'phone_number' => '32321',
                'address' => 'nasirabad',
                'city' => 'chittagong',
                'state' => '',
                'postal_code' => '',
                'country' => 'bd',
                'is_active' => 1,
                'created_at' => '2018-09-01 09:29:54',
                'updated_at' => '2018-10-07 08:05:51',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'a',
                'image' => NULL,
                'company_name' => 'a',
                'vat_number' => NULL,
                'email' => 'a@a.com',
                'phone_number' => 'q',
                'address' => 'q',
                'city' => 'q',
                'state' => NULL,
                'postal_code' => NULL,
                'country' => NULL,
                'is_active' => 0,
                'created_at' => '2018-10-07 08:03:39',
                'updated_at' => '2018-10-07 08:04:18',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'a',
                'image' => NULL,
                'company_name' => 'a',
                'vat_number' => NULL,
                'email' => 'a@a.com',
                'phone_number' => 'a',
                'address' => 'a',
                'city' => 'a',
                'state' => NULL,
                'postal_code' => NULL,
                'country' => NULL,
                'is_active' => 0,
                'created_at' => '2018-10-07 08:04:36',
                'updated_at' => '2018-10-07 08:06:07',
            ),
            6 => 
            array (
                'id' => 8,
                'name' => 'x',
                'image' => 'x.png',
                'company_name' => 'x',
                'vat_number' => NULL,
                'email' => 'x@x.com',
                'phone_number' => 'x',
                'address' => 'x',
                'city' => 'x',
                'state' => NULL,
                'postal_code' => NULL,
                'country' => NULL,
                'is_active' => 1,
                'created_at' => '2019-03-18 16:32:42',
                'updated_at' => '2019-12-21 16:31:24',
            ),
        ));
        
        
    }
}