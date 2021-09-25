<?php

namespace App\Services;

use App\Models\Season;
use App\Models\Serie;
use Illuminate\Support\Facades\DB;

class CreateSerie
{
    public function create(
        String $name, 
        int $qntSeason,
        int $epBySeason,
        ?string $cover // ? -> obrigatório ser passado o parâmetro mas podendo não ser uma string
    ): Serie {
        DB::beginTransaction();
        $serie = Serie::create([
            'name' => $name, 
            'cover' => $cover
        ]);
        $this->createSeason($serie, $qntSeason, $epBySeason);
        DB::commit();

        return $serie;
    }

    /**
     * @param $serie
     * @param int $qntSeason
     * @param int $epBySeason
     */
    private function createSeason(Serie $serie, int $qntSeason, int $epBySeason): void
    {
        for ($i = 1; $i <= $qntSeason; $i++) {
            $season = $serie->seasons()->create(['number' => $i]);
            $this->createEpisode($season, $epBySeason);
        }
    }

    /**
     * @param $season
     * @param int $epBySeason
     */
    private function createEpisode(Season $season, int $epBySeason): void
    {
        for ($j=1; $j <= $epBySeason; $j++) { 
            $season->episodes()->create(['number' => $j]);
        }
    }
}