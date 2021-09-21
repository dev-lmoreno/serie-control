@extends('layout')

@section('header')
Serie
@endsection

@section('content')

@if (!empty($message))
    <div class="alert alert-success">{{ $message }}</div>    
@endif

<a href="{{ route('create_series') }}" class="btn btn-dark mb-2">Create</a>

<ul class="list-group">
    @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
           {{ $serie->name }}
           
           <span class="d-flex">
            <a href="/series/{{ $serie->id }}/seasons" class="btn btn-info btn-sm">
                <i class="fas fa-external-link-alt"></i>
            </a>

            <form method="post" action="/series/{{ $serie->id }}"
                    onsubmit="return confirm('Tem certeza que deseja remover a série {{addslashes($serie->name)}}')">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Remove</button>
            </form>
           </span>
        </li>
    @endforeach
</ul>
@endsection