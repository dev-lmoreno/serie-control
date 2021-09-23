<?php

namespace Tests\Feature;

use App\Services\CreateSerie;
use App\Services\RemoveSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RemoveSerieTest extends TestCase
{
    use RefreshDatabase;

    /** @var Serie */
    private $serie;

    /** Método chamado antes de cada teste rodar */
    protected function setUp(): void
    {
        parent::setUp();
        $serieCreator = new CreateSerie();
        $this->serie = $serieCreator->create('Nome da Série', 1, 1);
    }

    public function testRemoveSerie()
    {
        $this->assertDatabaseHas('series', ['id' => $this->serie->id]);
        $removeSerie = new RemoveSerie();
        $serieName = $removeSerie->remove($this->serie->id);
        $this->assertIsString($serieName);
        $this->assertEquals('Nome da Série', $this->serie->name);
        $this->assertDatabaseMissing('series', ['id' => $this->serie->id]);
    }
}
