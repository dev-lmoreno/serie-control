<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NewSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $name;
    public $qntTemp;
    public $qntEp;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($name,$qntTemp,$qntEp)
    {
        $this->name = $name;
        $this->qntTemp = $qntTemp;
        $this->qntEp = $qntEp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.newSerie');
    }
}
