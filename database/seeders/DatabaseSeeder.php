<?php

use Database\Seeders\MailTemplateSeeder;
use Database\Seeders\SqlFileSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(MailTemplateSeeder::class);
        $this->call(SqlFileSeeder::class);
    }
}
