<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\MailTemplate;
class MailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        MailTemplate::create(['template_name' => "Enquiry",'subject' => 'Test','bcc' => 'bcc@gmail.com', 'cc' => 'cc@gmail.com', 'mail_content' => 'mail_content' , 'is_active' => 1]);
    }
}
