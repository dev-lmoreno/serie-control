<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Models\Episode;
use App\Models\Season;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Services\CreateSerie;
use App\Services\RemoveSerie;

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
        $serie = $createSerie->create(
            $request->name, 
            $request->qnt_season, 
            $request->ep_by_season
        );

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
