<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RewardPointSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('reward_point_settings')->delete();
        
        \DB::table('reward_point_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'per_point_amount' => 300.0,
                'minimum_amount' => 1000.0,
                'duration' => 1,
                'type' => 'Year',
                'is_active' => 1,
                'created_at' => '2021-06-08 21:10:15',
                'updated_at' => '2021-06-27 10:50:55',
            ),
        ));
        
        
    }
}