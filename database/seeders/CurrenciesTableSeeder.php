<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('currencies')->delete();
        
        \DB::table('currencies')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'US Dollar',
                'code' => 'USD',
                'exchange_rate' => 1.0,
                'created_at' => '2020-11-01 05:52:58',
                'updated_at' => '2020-11-01 06:04:55',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Euro',
                'code' => 'Euro',
                'exchange_rate' => 0.85,
                'created_at' => '2020-11-01 06:59:12',
                'updated_at' => '2020-11-11 04:45:34',
            ),
        ));
        
        
    }
}