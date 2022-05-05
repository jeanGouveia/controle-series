<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\{Serie, Temporada, Episodio};

class RemovedorDeSerie
{
    public function excluirSerie(int $idSerie):string 
    {
        DB::beginTransaction();  
         $serie = Serie::find($idSerie);
         $nomeSerie = $serie->nome;
         $this->excluirTemporadas($serie);
         $serie->delete();
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