<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonateMail extends Mailable
{
    use Queueable, SerializesModels;
    private $amount;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($amount)
    {
        $this->amount=$amount;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('it.intersession.swapp@gmail.com')
            ->subject("Thanks for your support")
            ->markdown('emails.donate')->with('amount' , $this->amount);
        
        return $mail;
    }
}
