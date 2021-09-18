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
    <div class="form-group">
        <label for="name">Nome</label>
        <input id="name" type="text" class="form-control" name="name">
    </div>

    <button class="btn btn-primary">Adicionar</button>
</form>
@endsection