<?php

namespace Tests\Unit;

use App\Episodio;
use App\Temporada;
use Tests\TestCase;

class TemporadaTest extends TestCase
{
    /**
     * @var Temporada
     */
    private $temporada;

    protected function setUp(): void
    {
        parent::setUp();
        $temporada = new Temporada();

        $episodio1 = new Episodio();
        $episodio1->assistido = true;
        
        $episodio2 = new Episodio();
        $episodio2->assistido = false;
        
        $episodio3 = new Episodio();
        $episodio3->assistido = true;

        $temporada->episodios->add($episodio1);
        $temporada->episodios->add($episodio2);
        $temporada->episodios->add($episodio3);

        $this->temporada = $temporada;
    }

    public function testVerificaEpisodiosAssistidos()
    {
       //$this->assertCount(2,$this->temporada->getEpisodiosAssistidos()); se o retorno fosse o array
       $this->assertEquals(2, $this->temporada->getEpisodiosAssistidos());// o retorno é a quantidade (inteiro)
    }

    public function testVerificaEpisodios()
    {
        $this->assertCount(3,$this->temporada->episodios);
    }
}
