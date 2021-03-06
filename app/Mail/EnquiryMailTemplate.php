<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EnquiryMailTemplate extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // return $this->markdown('emails.myDemoMail');
        // return $this->from('noreplay@gmail.com')->markdown('mail.enquiry_mail_template')->with('details', $this->details);
        $this->from('noreplay@gmail.com')->markdown('mail.enquiry_mail_template')->with('details', $this->details);
         foreach ($this->details['attachment'] as $file){
            $this->attach($file);
        }
        return $this;
    }
}
