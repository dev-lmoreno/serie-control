<?php

namespace App\Http\Controllers;

use App\Events\NewSerie;
use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Models\User;
use App\Services\CreateSerie;
use App\Services\RemoveSerie;
use Illuminate\Support\Facades\Mail;

class SeriesController extends Controller
{
    public function index(Request $request)
    {
        $series = Serie::query()
            ->orderBy('name')
            ->get();

        $message = $request->session()
            ->get('message');
        

        return view('series.index', compact('series', 'message'));
    }

    public function create()
    {
        return view('series.create');
    }

    public function store(
        SeriesFormRequest $request, CreateSerie $createSerie
    ) {
        $cover = null;

        if ($request->hasFile('cover')) {
            $cover = $request->file('cover')->store('public/serie');
        }

        $serie = $createSerie->create(
            $request->name, 
            $request->qnt_season, 
            $request->ep_by_season,
            $cover
        );

        // adicionando evento
        $eventNewSerie = new NewSerie(
            $request->name, 
            $request->qnt_season, 
            $request->ep_by_season
        );
        event($eventNewSerie);

        $request->session()
            ->flash(
                'message',
                "Série {$serie->name}, temporadas e episódios cadastrados com sucesso!"
            );

        return redirect()->route('list_series');
    }

    public function destroy(
        Request $request,
        RemoveSerie $removeSerie)
    {
        $serieName = $removeSerie->remove($request->id);

        Serie::where('id', $request->id)->delete();
        
        $request->session()
            ->flash(
                'message',
                "Série {$serieName} removida com sucesso!"
            );
        
            return redirect()->route('list_series');
    }

    public function edit(int $id, Request $request)
    {
        $newName = $request->name;
        $serie = Serie::find($id);
        $serie->name = $newName;
        $serie->save();
    }
}
