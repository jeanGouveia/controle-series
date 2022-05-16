<?php

namespace App\Listeners;

use App\User;
use App\Events\NovaSerie;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class EnviarEmailNovaSerieCadsatrada implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NovaSerie  $event
     * @return void
     */
    public function handle(NovaSerie $event)
    {
        $nomeSerie        = $event->nomeSerie;
        $qtd_temporadas   = $event->qtd_temporadas;
        $ep_por_temporada = $event->ep_por_temporada;

        $users = User::all();
        foreach($users as $indice => $user){
            $multiplicador = $indice +1;
            $email = new \App\Mail\NovaSerie(
                $nomeSerie,
                $qtd_temporadas,
                $ep_por_temporada
            );

            //titulo do email
            $email->subject = 'Nova Série Adicionada';

            //variável que armazena 5 segundos
            $when = now()->addSecond($multiplicador * 10);

            //envio do email
            Mail::to($user)->later($when,$email);
        }
    }
}
