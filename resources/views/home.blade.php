@extends('layouts.app')

@section('content')

<main>
    <h2>Bem-vinda!</h2>
    <p>
        O VetTech Care é um sistema que mostra como a tecnologia pode transformar
        o atendimento veterinário, tornando-o mais rápido, eficiente e humanizado.
    </p>


    @auth
        <p>Bem-vinda, {{ auth()->user()->name }}!</p>

        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn">Sair</button>
        </form>
    @endauth

    <br><br>

    <a href="/novo-pet" class="btn">Cadastrar um Animal</a>
</main>

@endsection
