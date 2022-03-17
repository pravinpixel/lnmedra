<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductTypesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        DB::table('product_types')->delete();


        DB::table('product_types')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Climbers',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Creepers',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Flowering plants',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Non-flowering plants',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Fruit Bearing Trees',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),5 => 
            array (
                'id' => 6,
                'name' => 'Avenue Trees',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),6 => 
            array (
                'id' => 7,
                'name' => 'Ornamental plants / Trees',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),7 => 
            array (
                'id' => 8,
                'name' => ' Shrubs',
                'is_active' => 1,
                'created_at' => NULL,
                'updated_at' => NULL,
            ),
        ));
    }
}