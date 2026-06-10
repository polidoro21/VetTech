@extends('layouts.app')

@section('title', 'VetTech - Visitantes')

@section('content')
<section class="rounded-3xl border border-slate-200 bg-white p-8 shadow-sm">
    <h1 class="font-display text-3xl font-extrabold text-slate-950">Bem-vindo a VetTech</h1>
    <p class="mt-4 max-w-3xl text-slate-600">
        Crie sua conta para acessar dashboard, cadastro de pets, consultas, telemedicina e carteirinha de vacinas.
    </p>
    <a href="{{ route('cadastro') }}" class="mt-6 inline-flex rounded-xl bg-blue-600 px-5 py-3 font-bold text-white">Criar conta</a>
</section>
@endsection
