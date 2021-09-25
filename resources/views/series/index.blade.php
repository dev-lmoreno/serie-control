@extends('layout')

@section('header')
Serie
@endsection

@section('content')

@include('utils.message', ['message' => $message])

@auth
    <a href="{{ route('create_series') }}" class="btn btn-dark mb-2">Create</a>
@endauth

<ul class="list-group">
    @foreach ($series as $serie)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div>
                <img src="{{$serie->cover_url}}" class="img-thumbnail" height="100px" width="100px">
                <span id="name-serie-{{ $serie->id }}">{{ $serie->name }}</span>
            </div>
            
            <div class="input-group w-50" hidden id="input-name-serie-{{ $serie->id }}">
                <input type="text" class="form-control" value="{{ $serie->name }}">
                <div class="input-group-append">
                    <button class="btn btn-primary" onclick="edit({{ $serie->id }})">
                        CONFIRMAR
                        {{-- <i class="fas fa-check"></i> --}}
                    </button>
                    @csrf
                </div>
            </div>
           
           <span class="d-flex">
            @auth
                <button class="btn-info btn-sm mr-1" onClick="toggleInput({{$serie->id}})">EDITAR</button>
            @endauth
            
            <a href="/series/{{ $serie->id }}/seasons" class="btn btn-info btn-sm">
                VER TEMP
                {{-- <i class="fas fa-external-link-alt"></i> --}}
            </a>
            @auth
                <form method="post" action="/series/{{ $serie->id }}"
                        onsubmit="return confirm('Tem certeza que deseja remover a série {{addslashes($serie->name)}}')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm">Remove</button>
                </form>
            @endauth
           </span>
        </li>
    @endforeach
</ul>

<script>
    function toggleInput(serieId) {
        const inputNameSerieEl = document.getElementById(`input-name-serie-${serieId}`);
        const nameSerieEl = document.getElementById(`name-serie-${serieId}`);

        if (nameSerieEl.hasAttribute('hidden')) {
            nameSerieEl.removeAttribute('hidden');
            inputNameSerieEl.hidden = true;
        } else {
            inputNameSerieEl.removeAttribute('hidden');
            nameSerieEl.hidden = true;
        }

        
    }

    function edit(serieId) {
        let formData = new FormData();
        const name = document
            .querySelector(`#input-name-serie-${serieId} > input`)
            .value;
        const token = document.querySelector('input[name="_token"]').value;
        
        formData.append('name', name);
        formData.append('_token', token);
        
        const url = `/series/${serieId}/edit`;
        fetch(url, {
            body: formData,
            method: 'POST'
        }).then(() => {
            toggleInput(serieId);
            document.getElementById(`name-serie-${serieId}`).textContent = name;
        });
    }
</script>
@endsection