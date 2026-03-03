@extends('layout')

@section('content')

<div class="form-container">

    <h2>Cadastro de Animal</h2>

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="/cadastro" method="POST">
        @csrf

        <div class="form-group">
            <label>Nome do Animal</label>
            <input type="text" name="nome" required>
        </div>

        <div class="form-group">
            <label>Espécie</label>
            <input type="text" name="especie" required>
        </div>

        <div class="form-group">
            <label>Raça</label>
            <input type="text" name="raca" required>
        </div>

        <div class="form-group">
            <label>Idade</label>
            <input type="number" name="idade" required>
        </div>

        <div class="form-group">
            <label>Nome do Dono</label>
            <input type="text" name="nome_dono" required>
        </div>

        <button type="submit" class="btn-primary">Cadastrar</button>
    </form>

</div>

@endsection
