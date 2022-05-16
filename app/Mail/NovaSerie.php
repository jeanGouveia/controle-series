<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NovaSerie extends Mailable
{
    use Queueable, SerializesModels;

    public $nome;
    public $qtdTemporadas;
    public $qtdEpisodiosPorTemp;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($nome, $qtdTemporadas, $qtdEpisodiosPorTemp)
    {
        $this->nome = $nome;
        $this->qtdTemporadas = $qtdTemporadas;
        $this->qtdEpisodiosPorTemp = $qtdEpisodiosPorTemp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.serie.novaSerie');
    }
}
