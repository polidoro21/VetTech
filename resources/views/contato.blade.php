@extends('layouts.app')

@section('title', 'VetTech - Contato')

@section('content')
<section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="font-display text-3xl font-extrabold text-slate-950">Fale Conosco</h1>

    <form action="{{ route('contato.enviar') }}" method="POST" class="mt-6 grid max-w-2xl gap-4">
        @csrf
        <input class="rounded-xl border border-slate-300 px-4 py-3" type="text" name="nome" placeholder="Seu nome">
        <input class="rounded-xl border border-slate-300 px-4 py-3" type="email" name="email" placeholder="Seu email">
        <textarea class="min-h-32 rounded-xl border border-slate-300 px-4 py-3" name="mensagem" placeholder="Sua mensagem"></textarea>
        <button class="w-fit rounded-xl bg-blue-600 px-5 py-3 font-bold text-white" type="submit">Enviar</button>
    </form>

    <a href="{{ route('clinicas.index') }}" class="mt-6 inline-flex rounded-xl border border-slate-300 px-5 py-3 font-bold text-slate-700">
        Buscar clinicas proximas
    </a>
</section>
@endsection
