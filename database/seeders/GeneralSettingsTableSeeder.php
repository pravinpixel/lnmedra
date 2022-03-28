<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class GeneralSettingsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('general_settings')->delete();
        
        \DB::table('general_settings')->insert(array (
            0 => 
            array (
                'id' => 1,
                'site_title' => 'L&N Medra',
                'site_logo' => '20220324063229.png',
                'is_rtl' => 0,
                'created_at' => '2018-07-06 11:43:11',
                'updated_at' => '2022-03-24 18:05:17',
                'currency' => '1',
                'staff_access' => 'own',
                'date_format' => 'd/m/Y',
                'developed_by' => 'Pixel Studios Pvt Ltd',
                'invoice_format' => 'gst',
                'state' => 1,
                'theme' => 'default.css',
                'currency_position' => 'prefix',
            ),
        ));
        
        
    }
}