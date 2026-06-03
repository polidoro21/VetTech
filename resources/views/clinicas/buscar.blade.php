@extends('layout')

@section('content')

<h1>Buscar Clínicas</h1>

<form action="{{ route('clinicas.buscar') }}" method="GET">

    <input type="text" name="busca" placeholder="Digite cidade ou clínica">

    <button type="submit">
        Buscar
    </button>

</form>

@endsection
