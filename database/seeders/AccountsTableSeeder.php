<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        \DB::table('accounts')->delete();
        
        \DB::table('accounts')->insert(array (
            0 => 
            array (
                'id' => 1,
                'account_no' => '11111',
                'name' => 'Sales Account',
                'initial_balance' => 1000.0,
                'total_balance' => 1000.0,
                'note' => 'this is first account',
                'is_default' => 1,
                'is_active' => 1,
                'created_at' => '2018-12-18 08:28:02',
                'updated_at' => '2019-01-20 15:29:06',
            )
        ));
    }
}