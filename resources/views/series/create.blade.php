@extends('layout')

@section('header')
Adicionar serie
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form method="post">
    @csrf
    <div class="row">    
        <div class="col col-8">
            <label for="name">Nome</label>
            <input id="name" type="text" class="form-control" name="name">
        </div>

        <div class="col col-2">
            <label for="qnt_season">Nº Temporadas</label>
            <input type="number" class="form-control" name="qnt_season">
        </div>

        <div class="col col-2">
            <label for="ep_by_season">Ep. por Temporadas</label>
            <input type="number" class="form-control" name="ep_by_season">
        </div>
    </div>

    <button class="btn btn-primary mt-2">Adicionar</button>
</form>
@endsection