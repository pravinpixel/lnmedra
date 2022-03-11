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
                'id' => 3,
                'title' => 'HP',
                'image' => 'HP.jpg',
                'is_active' => 0,
                'created_at' => '2018-05-12 14:36:14',
                'updated_at' => '2022-03-04 12:44:28',
            ),
            1 => 
            array (
                'id' => 4,
                'title' => 'samsung',
                'image' => 'samsung.jpg',
                'is_active' => 0,
                'created_at' => '2018-05-12 14:38:41',
                'updated_at' => '2022-03-04 12:44:34',
            ),
            2 => 
            array (
                'id' => 5,
                'title' => 'Apple',
                'image' => 'Apple.jpg',
                'is_active' => 0,
                'created_at' => '2018-09-01 05:04:49',
                'updated_at' => '2022-03-04 12:44:38',
            ),
            3 => 
            array (
                'id' => 6,
                'title' => 'jjjj',
                'image' => '20201019093419.jpg',
                'is_active' => 0,
                'created_at' => '2020-10-19 21:03:52',
                'updated_at' => '2020-10-19 21:05:58',
            ),
            4 => 
            array (
                'id' => 7,
                'title' => 'Lotto',
                'image' => NULL,
                'is_active' => 1,
                'created_at' => '2020-11-16 09:43:41',
                'updated_at' => '2020-11-16 09:43:41',
            ),
            5 => 
            array (
                'id' => 8,
                'title' => 'La Petite Bouquet',
                'image' => '20220304112555.jpg',
                'is_active' => 1,
                'created_at' => '2022-03-04 11:25:55',
                'updated_at' => '2022-03-04 11:25:55',
            ),
            6 => 
            array (
                'id' => 9,
                'title' => 'Bridal Bouquet',
                'image' => '20220304121232.jpg',
                'is_active' => 1,
                'created_at' => '2022-03-04 12:12:32',
                'updated_at' => '2022-03-04 12:12:32',
            ),
            7 => 
            array (
                'id' => 10,
                'title' => 'WOLF GARTEN Tools',
                'image' => '20220304122300.jpg',
                'is_active' => 1,
                'created_at' => '2022-03-04 12:23:00',
                'updated_at' => '2022-03-04 12:23:00',
            ),
            8 => 
            array (
                'id' => 11,
                'title' => 'The Garden Store',
                'image' => '20220304122709.jpg',
                'is_active' => 1,
                'created_at' => '2022-03-04 12:27:09',
                'updated_at' => '2022-03-04 12:27:09',
            ),
        ));
        
        
    }
}