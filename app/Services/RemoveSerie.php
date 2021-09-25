<?php

namespace App\Services;

use App\Events\deleteSerie;
use App\Jobs\deleteCoverSerie;
use App\Models\{Serie, Season, Episode};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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

            // serie convertida para objeto puro do php para que o job consiga ser executado 
            // e excluir a imagem, a model excluia a serie primeiro e quando o job ia ser executado
            // o laravel não consegui desserializar a informação do id para deletar a imagem
            $serieObj = (object) $serie->toArray();

            $this->removeSeason($serie);
            $serie->delete();

            $event = new deleteSerie($serieObj); // criando o evento e passando o objeto serie
            event($event); // emitindo o evento
            
            //chamada do job de excluir imagem
            deleteCoverSerie::dispatch($serieObj);

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