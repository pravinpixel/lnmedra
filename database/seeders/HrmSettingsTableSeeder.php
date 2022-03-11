<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class HrmSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('hrm_settings')->delete();
        
        \DB::table('hrm_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'checkin' => '10:00am',
                'checkout' => '6:00pm',
                'created_at' => '2019-01-02 07:50:08',
                'updated_at' => '2019-01-02 09:50:53',
            ),
        ));
        
        
    }
}