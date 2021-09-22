<?php

namespace App\Services;

use App\Models\{Serie, Season, Episode};
use Illuminate\Support\Facades\DB;

class RemoveSerie
{
    public function remove(
        int $serieId
    ): string {
        
        // por conta do php fazer um cópia da variável $serieName
        // e de dentro da transaction o valor da variável
        // $serieName não ser refletido no seu valor externo a função
        // da transaction, está sendo passado por referência essa
        // variável, com isso consigo pegar o valor da variável alterado
        $serieName = '';
        DB::transaction(function() use ($serieId, &$serieName){
            $serie = Serie::find($serieId);
            $this->removeSeason($serie);
            $serie->delete();
        });
        

        return $serieName;
    }


    //private -> só vai ser utilizado aqui nessa classe
    private function removeSeason(Serie $serie): void
    {
        $serie->seasons->each(function (Season $season) {
            $this->removeEpisode($season);
            $season->delete();
        });
    }

    //private -> só vai ser utilizado aqui nessa classe
    private function removeEpisode(Season $season): void
    {
        $season->episodes()->each(function(Episode $episode) {
            $episode->delete();
        });
    }
}