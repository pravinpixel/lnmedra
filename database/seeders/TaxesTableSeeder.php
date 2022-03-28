<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class TaxesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('taxes')->delete();
        
        \DB::table('taxes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Vat 10',
                'rate' => 10.0,
                'is_active' => 1,
                'created_at' => '2022-03-18 11:41:20',
                'updated_at' => '2022-03-18 11:41:20',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'CGST',
                'rate' => 2.5,
                'is_active' => 1,
                'created_at' => '2022-03-18 11:41:57',
                'updated_at' => '2022-03-18 11:41:57',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'SGST',
                'rate' => 2.5,
                'is_active' => 1,
                'created_at' => '2022-03-18 11:42:08',
                'updated_at' => '2022-03-18 11:42:08',
            ),
        ));
        
        
    }
}