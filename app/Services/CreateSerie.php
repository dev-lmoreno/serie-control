<?php

namespace App\Services;

use App\Models\Serie;

class CreateSerie
{
    public function create(
        String $name, 
        int $qnt_temp,
        int $ep_by_season
    ): Serie {
        $serie = Serie::create([
            'name' => $name
        ]);

        for ($i = 1; $i <= $qnt_temp; $i++) {
            $season = $serie->seasons()->create(['number' => $i]);
                for ($j=1; $j <= $ep_by_season; $j++) { 
                    $season->episodes()->create(['number' => $j]);
                }
        }

        return $serie;
    }
}