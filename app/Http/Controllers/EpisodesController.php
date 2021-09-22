<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;

class EpisodesController extends Controller
{
    public function index(Season $season, Request $request)
    {
        // passando o valor na rota com o mesmo nome da variável $season
        // já é criada um valor da temporada, é semelhante ao código abaixo
        // $seasons = Season::find($idSeason);
        // $episodes = $seasons->episodes;

        $episodes = $season->episodes;
        $seasonId = $season->id;

        //return view('episodes.index', compact('episodes'));
        // outra maneira para retornar os dados para a view sem o compact
        return view('episodes.index', [
            'episodes' => $episodes,
            'seasonId' => $seasonId,
            'message' => $request->session()->get('message')
        ]);
    }

    public function watched(Season $season, Request $request)
    {
        $watchedEpisodes = $request->episodes;
        //each -> método que recebe uma collection que será executado para cada item dessa collection
        $season->episodes->each(function (Episode $episode) use ($watchedEpisodes) {
            $episode->watched = in_array(
                $episode->id, $watchedEpisodes
            );
        });
        $season->push();

        $request->session()->flash(
            'message',
            'Episodes marked!'
        );

        return redirect()->back();
    }
}
