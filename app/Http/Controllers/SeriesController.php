<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;
use App\Services\CreateSerie;

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

    public function destroy(Request $request)
    {
        Serie::where('id', $request->id)->delete();
        
        $request->session()
            ->flash(
                'message',
                "Série removida com sucesso!"
            );
        
            return redirect()->route('list_series');
    }
}
