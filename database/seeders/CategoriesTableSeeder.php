<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Plants',
                'image' => '20220324062634.jpg',
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2022-03-22 11:11:59',
                'updated_at' => '2022-03-24 18:26:34',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Soil',
                'image' => '20220324062651.jpg',
                'parent_id' => 1,
                'is_active' => 1,
                'created_at' => '2022-03-22 11:12:10',
                'updated_at' => '2022-03-24 18:26:51',
            ),
        ));
        
        
    }
}