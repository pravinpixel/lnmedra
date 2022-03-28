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
                'name' => 'Indian Rupees',
                'code' => 'INR',
                'exchange_rate' => 1.0,
                'created_at' => '2020-11-01 05:52:58',
                'updated_at' => '2020-11-01 06:04:55',
            ),
        ));
        
        
    }
}