@extends('layouts.app')

@section('content')

<h2>Cadastrar Atendimento</h2>

<form method="POST" action="{{ route('atendimentos.store') }}">
    @csrf

    <label>Nome do Animal:</label><br>
    <input type="text" name="animal" required><br><br>

    <label>Descrição:</label><br>
    <textarea name="descricao" required></textarea><br><br>

    <label>Data:</label><br>
    <input type="date" name="data" required><br><br>

    <button type="submit">Salvar Atendimento</button>
</form>

@endsection
