<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NovaSerie
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $nomeSerie;
    public $qtd_temporadas;
    public $ep_por_temporada;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($nomeSerie, $qtd_temporadas, $ep_por_temporada)
    {
        $this->nomeSerie = $nomeSerie;
        $this->qtd_temporadas = $qtd_temporadas;
        $this->ep_por_temporada = $ep_por_temporada;

    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
