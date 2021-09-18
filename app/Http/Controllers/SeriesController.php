<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use Illuminate\Http\Request;
use App\Models\Serie;

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

    public function store(SeriesFormRequest $request)
    {
        $name = $request->name;
        $serie = Serie::create([
            'name' => $name
        ]);

        $request->session()
            ->flash(
                'message',
                "Série {$serie->name} cadastrada com sucesso!"
            );

        return redirect()->route('list_series');
    }

    public function destroy(Request $request)
    {
        Serie::where('id_serie', $request->id_serie)->delete();
        
        $request->session()
            ->flash(
                'message',
                "Série removida com sucesso!"
            );
        
            return redirect()->route('list_series');
    }
}
