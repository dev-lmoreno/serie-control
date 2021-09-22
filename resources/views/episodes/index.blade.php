@extends('layout')

@section('header')
    Episodes
@endsection

@section('content')
<form action="/seasons/{{ $seasonId }}/episodes/watched" method="POST">
    @include('utils.message', ['message' => $message])
    
    @csrf
    <ul class="list-group">
        @foreach ($episodes as $episode)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            Episode {{ $episode->number }}
            <input type="checkbox" name="episodes[]" value="{{ $episode->id }}" 
                {{ $episode->watched ? 'checked' : '' }}>
        </li>
        @endforeach
    </ul>

    <button class="btn btn-primary mt-2 mb-2">Salvar</button>
</form>
@endsection