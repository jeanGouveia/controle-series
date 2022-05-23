<?php

namespace App\Services;

use App\Serie;
use App\Temporada;
use Illuminate\Support\Facades\DB;

class CriadorDeSerie
{
    public function criarSerie(
        string $nomeSerie, 
        int $qtdTemporadas, 
        int $epPorTemporada,
        string $capa = null
        ):Serie {
            DB::beginTransaction();
             $serie = Serie::create([
                 'nome' => $nomeSerie,
                 'capa' => $capa
                ]);
             $this->criaTemporadas($serie, $qtdTemporadas, $epPorTemporada);
            DB::commit();
            return $serie;
    }

    public function criaTemporadas(Serie $serie, int $qtdTemporadas, int $episodiosPorTemp)
    {
        for($i = 1; $i <= $qtdTemporadas; $i++){
            $temporadas = $serie->temporadas()->create(['numero' => $i]);
            $this->criaEpisodios($temporadas, $episodiosPorTemp);
        }
    }

    public function criaEpisodios(Temporada $temporadas, int $episodiosPorTemp)
    {
        for($j = 1; $j <= $episodiosPorTemp; $j++){
            $temporadas->episodios()->create(['numero' => $j]);
        }
    }
}