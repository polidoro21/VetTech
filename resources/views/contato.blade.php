@extends('layouts.app')

@section('content')
<section class="conteudo">
    <h2>Fale Conosco</h2>

    <form action="{{ route('contato.enviar') }}" method="POST">
        @csrf

        <input type="text" name="nome" placeholder="Seu nome">
        <input type="email" name="email" placeholder="Seu email">
        <textarea name="mensagem" placeholder="Sua mensagem"></textarea>

        <button type="submit">Enviar</button>
    </form>

    <a href="{{ route('clinicas.buscar') }}">
        <button type="button" style="margin-top:10px;">
            Buscar clínicas próximas 🐾
        </button>
    </a>
</section>
@endsection
