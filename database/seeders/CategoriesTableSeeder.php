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
                'name' => 'Fruits',
                'image' => NULL,
                'parent_id' => 9,
                'is_active' => 1,
                'created_at' => '2018-05-12 08:57:25',
                'updated_at' => '2022-03-05 16:10:24',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'electronics',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2018-05-12 09:05:57',
                'updated_at' => '2022-03-05 16:10:12',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'computer',
                'image' => '20200701093146.jpg',
                'parent_id' => 2,
                'is_active' => 1,
                'created_at' => '2018-05-12 09:06:08',
                'updated_at' => '2022-03-05 16:05:31',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'toy',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2018-05-24 04:27:48',
                'updated_at' => '2022-03-05 16:10:47',
            ),
            4 => 
            array (
                'id' => 7,
                'name' => 'jacket',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2018-05-28 04:09:51',
                'updated_at' => '2022-03-05 16:10:30',
            ),
            5 => 
            array (
                'id' => 9,
                'name' => 'food',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2018-06-25 06:51:40',
                'updated_at' => '2022-03-05 16:10:19',
            ),
            6 => 
            array (
                'id' => 10,
                'name' => 'anda',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2018-08-29 05:06:31',
                'updated_at' => '2018-08-29 05:07:34',
            ),
            7 => 
            array (
                'id' => 11,
                'name' => 'anda',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2018-08-29 05:18:06',
                'updated_at' => '2018-08-29 05:23:22',
            ),
            8 => 
            array (
                'id' => 12,
                'name' => 'accessories',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2018-12-05 04:58:53',
                'updated_at' => '2022-03-04 11:50:31',
            ),
            9 => 
            array (
                'id' => 14,
                'name' => 'nn',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2019-04-10 09:52:30',
                'updated_at' => '2019-04-10 11:08:47',
            ),
            10 => 
            array (
                'id' => 15,
                'name' => 'nm',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2019-04-10 09:52:36',
                'updated_at' => '2022-03-05 16:10:35',
            ),
            11 => 
            array (
                'id' => 16,
                'name' => 'desktop',
                'image' => NULL,
                'parent_id' => 3,
                'is_active' => 0,
                'created_at' => '2020-03-11 16:12:33',
                'updated_at' => '2022-03-05 16:06:12',
            ),
            12 => 
            array (
                'id' => 17,
                'name' => 'tostos',
                'image' => '20200701080042.png',
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2020-07-01 19:30:42',
                'updated_at' => '2020-07-01 21:05:34',
            ),
            13 => 
            array (
                'id' => 19,
                'name' => 'Paracetamol',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2021-03-07 12:46:01',
                'updated_at' => '2022-03-04 12:43:31',
            ),
            14 => 
            array (
                'id' => 20,
                'name' => 'Automobile',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2021-07-15 18:05:12',
                'updated_at' => '2022-03-04 12:42:57',
            ),
            15 => 
            array (
                'id' => 21,
                'name' => 'test',
                'image' => '20220222111352.png',
                'parent_id' => 1,
                'is_active' => 0,
                'created_at' => '2022-02-22 11:13:52',
                'updated_at' => '2022-03-05 16:06:58',
            ),
            16 => 
            array (
                'id' => 22,
                'name' => 'test1',
                'image' => '20220222123857.png',
                'parent_id' => 21,
                'is_active' => 0,
                'created_at' => '2022-02-22 12:38:57',
                'updated_at' => '2022-03-05 16:07:12',
            ),
            17 => 
            array (
                'id' => 23,
                'name' => 'Flowers',
                'image' => '20220304112237.jpg',
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2022-03-04 11:22:37',
                'updated_at' => '2022-03-04 11:46:46',
            ),
            18 => 
            array (
                'id' => 24,
                'name' => 'cultivars',
                'image' => '20220304112349.jpg',
                'parent_id' => 23,
                'is_active' => 0,
                'created_at' => '2022-03-04 11:23:49',
                'updated_at' => '2022-03-05 16:05:22',
            ),
            19 => 
            array (
                'id' => 25,
                'name' => 'Hardscape',
                'image' => '20220304114821.jpeg',
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2022-03-04 11:48:21',
                'updated_at' => '2022-03-04 11:48:21',
            ),
            20 => 
            array (
                'id' => 26,
                'name' => 'Tools',
                'image' => '20220304114939.jpg',
                'parent_id' => 25,
                'is_active' => 1,
                'created_at' => '2022-03-04 11:49:39',
                'updated_at' => '2022-03-04 11:49:39',
            ),
            21 => 
            array (
                'id' => 27,
                'name' => 'Accessories',
                'image' => '20220304115041.jpg',
                'parent_id' => 25,
                'is_active' => 1,
                'created_at' => '2022-03-04 11:50:41',
                'updated_at' => '2022-03-04 11:50:41',
            ),
            22 => 
            array (
                'id' => 28,
                'name' => 'Softscape',
                'image' => '20220304115126.jpg',
                'parent_id' => NULL,
                'is_active' => 1,
                'created_at' => '2022-03-04 11:51:26',
                'updated_at' => '2022-03-04 11:51:26',
            ),
            23 => 
            array (
                'id' => 29,
                'name' => 'Plants',
                'image' => '20220304115157.jpg',
                'parent_id' => 28,
                'is_active' => 1,
                'created_at' => '2022-03-04 11:51:57',
                'updated_at' => '2022-03-05 16:11:13',
            ),
            24 => 
            array (
                'id' => 30,
                'name' => 'Soil & Manure',
                'image' => '20220304115345.jpeg',
                'parent_id' => 28,
                'is_active' => 1,
                'created_at' => '2022-03-04 11:53:45',
                'updated_at' => '2022-03-04 11:53:45',
            ),
            25 => 
            array (
                'id' => 31,
                'name' => 'Testing Child Category',
                'image' => NULL,
                'parent_id' => NULL,
                'is_active' => 0,
                'created_at' => '2022-03-04 17:50:36',
                'updated_at' => '2022-03-05 16:10:42',
            ),
            26 => 
            array (
                'id' => 32,
                'name' => 'child',
                'image' => NULL,
                'parent_id' => 31,
                'is_active' => 0,
                'created_at' => '2022-03-04 17:50:55',
                'updated_at' => '2022-03-05 15:56:39',
            ),
        ));
        
        
    }
}