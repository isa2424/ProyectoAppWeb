<?php

namespace SistemaWeb\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarMensaje extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The demo object instance.
     *
     * @var Demo
     */
    public $data;
    public $user;


    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user,$data)
    {
        $this->data = $data;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
{
    return $this->markdown('emails.mensaje')->subject('Mensaje del Administrador');
}
}
