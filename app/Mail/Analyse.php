<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Analyse extends Mailable
{
    use Queueable, SerializesModels;
    private $files;
    private $project;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($files, $project)
    {
        $this->files = $files;
        $this->project = $project;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $mail = $this->from('it.intersession.swapp@gmail.com')
            ->subject("Analyse du projet $this->project")
            ->markdown('emails.analyse');
        // Joindre les fichiers à envoyer par mail:
        foreach ($this->files as $file){
            $mail->attach($file);
        }
        return $mail;
    }
}
