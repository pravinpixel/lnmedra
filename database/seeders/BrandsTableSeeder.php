<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 1,
                'title' => 'Bugs',
                'image' => '20220324070006.png',
                'is_active' => 1,
                'created_at' => '2022-03-22 11:13:08',
                'updated_at' => '2022-03-24 19:00:06',
            ),
        ));
        
        
    }
}