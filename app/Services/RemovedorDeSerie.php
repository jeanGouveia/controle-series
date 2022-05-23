<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\{Serie, Temporada, Episodio};
use App\Events\SerieApagada;
use App\Jobs\ExcluirCapaSerie;
use Illuminate\Support\Facades\Storage;

class RemovedorDeSerie
{
    public function excluirSerie(int $idSerie):string 
    {
        DB::beginTransaction();  
        $serie = Serie::find($idSerie);
        $serieObj = (object) $serie->toArray();
        $nomeSerie = $serie->nome;
        $this->excluirTemporadas($serie);
        $serie->delete();

        /*$evento = new SerieApagada($serieObj);
        event($evento);*/

        ExcluirCapaSerie::dispatch($serieObj);

        DB::commit();
        return $nomeSerie;
    }

    private function excluirTemporadas(Serie $serie)
    {
        $serie->temporadas->each(function(Temporada $temporada){
            $this->excluirEpisodios($temporada);
            $temporada->delete();
        });
    }

    private function excluirEpisodios(Temporada $temporada)
    {
        $temporada->episodios->each(function(Episodio $episodio){
            $episodio->delete();
        });
    }
}