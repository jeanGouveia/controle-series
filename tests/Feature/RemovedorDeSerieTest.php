<?php

namespace Tests\Feature;

use App\Services\CriadorDeSerie;
use Tests\TestCase;
use App\Services\RemovedorDeSerie;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RemovedorDeSerieTest extends TestCase
{
    use RefreshDatabase;

    /** @var Serie */
    private $serie;
    protected function setUp():void
    {
        parent::setUp();
        $criadorDeSerie = new CriadorDeSerie();
        $this->serie = $criadorDeSerie->criarSerie('Nova Serie', 1, 1);
    }

    public function testRemoverSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);

        $removedorDeSerie = new RemovedorDeSerie();
        $nomeSerie = $removedorDeSerie->excluirSerie($this->serie->id);

        $this->assertIsString($nomeSerie);
        $this->assertEquals('Nova Serie', $nomeSerie);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
