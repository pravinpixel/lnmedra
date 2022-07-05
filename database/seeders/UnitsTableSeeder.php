<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UnitsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {

        \DB::table('units')->delete();

        \DB::table('units')->insert(array(
            0 =>
            array(
                'id' => 1,
                'unit_code' => 'pc',
                'unit_name' => 'Piece',
                'base_unit' => NULL,
                'operator' => '*',
                'operation_value' => 1.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 07:57:46',
                'updated_at' => '2018-08-18 03:11:53',
            ),
            1 =>
            array(
                'id' => 2,
                'unit_code' => 'dozen',
                'unit_name' => 'dozen box',
                'base_unit' => 1,
                'operator' => '*',
                'operation_value' => 12.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 15:27:05',
                'updated_at' => '2018-05-12 15:27:05',
            ),
            2 =>
            array(
                'id' => 3,
                'unit_code' => 'cartoon',
                'unit_name' => 'cartoon box',
                'base_unit' => 1,
                'operator' => '*',
                'operation_value' => 24.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 15:27:45',
                'updated_at' => '2020-03-11 16:06:59',
            ),
            3 =>
            array(
                'id' => 4,
                'unit_code' => 'square',
                'unit_name' => 'square meter',
                'base_unit' => 1,
                'operator' => '*',
                'operation_value' => 12.0,
                'is_active' => 1,
                'created_at' => '2018-05-12 15:27:55',
                'updated_at' => '2020-03-11 16:06:59',
            )

        ));
    }
}
