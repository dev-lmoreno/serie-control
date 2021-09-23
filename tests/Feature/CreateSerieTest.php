<?php

namespace Tests\Feature;

use App\Models\Serie;
use App\Services\CreateSerie;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CreateSerieTest extends TestCase
{
    use RefreshDatabase;

    public function testCreateSerie()
    {
        $serieCreator = new CreateSerie();
        $nameSerie = 'Nome teste';
        $createdSerie = $serieCreator->create($nameSerie, 1, 1);

        $this->assertInstanceOf(Serie::class, $createdSerie);
        $this->assertDatabaseHas('series', ['name' => $nameSerie]);
        $this->assertDatabaseHas('seasons', 
            ['serie_id' => $createdSerie->id, 'number' => 1]);
        $this->assertDatabaseHas('episodes', ['number' => 1]);

    }
}
