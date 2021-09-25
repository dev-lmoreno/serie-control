@extends('layout')

@section('header')
Seasons of {{$serie->name}}
@endsection

@section('content')
    @if($serie->cover)
        <div class="row mb-4">
            <div class="col-md-12 text-center">
                <a href="{{$serie->cover_url}}" target="_blank">
                    <img src="{{$serie->cover_url}}" class="img-thumbnail" height="400px" width="400px">
                </a>
            </div>
        </div>
    @endif
    

    <ul class="list-group">
        @foreach ($seasons as $season)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <a href="/seasons/{{ $season->id }}/episodes">
                Season {{ $season->number }}
            </a>

            {{-- <span class="badge badge-danger"> --}}
                {{ $season->getWatchedEpisodes()->count() }} / {{ $season->episodes->count() }}
            {{-- </span> --}}
        </li>
        @endforeach
    </ul>
@endsection