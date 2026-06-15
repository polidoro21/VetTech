@extends('layouts.dashboard')

@section('title', 'VetTech - '.$animal->nome)
@section('page-title', $animal->nome)
@section('page-subtitle', 'Perfil do pet')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1fr_.8fr]">
    <section class="vt-card p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h2 class="font-display text-2xl font-bold text-slate-950">{{ $animal->nome }}</h2>
                <p class="text-slate-500">{{ $animal->especie }} {{ $animal->raca ? '- '.$animal->raca : '' }}</p>
            </div>
            <a href="{{ route('animais.edit', $animal->id) }}" class="vt-btn vt-btn-primary px-4 py-2">Editar</a>
        </div>

        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Nascimento</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $animal->data_nascimento ? $animal->data_nascimento->format('d/m/Y') : 'Nao informado' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Idade</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $animal->idade !== null ? $animal->idade.' anos' : 'Nao informada' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Cor</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $animal->cor ?: 'Nao informada' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Porte</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ ucfirst($animal->porte) }}</dd>
            </div>
        </dl>
    </section>

    <section class="vt-card p-6">
        <h3 class="font-display text-lg font-bold text-slate-950">Atalhos</h3>
        <div class="mt-4 grid gap-3">
            <a href="{{ route('atendimentos.create', ['animal_id' => $animal->id]) }}" class="vt-btn vt-btn-primary px-4 py-3">Solicitar atendimento</a>
            <a href="{{ route('vacinas.index') }}" class="vt-btn vt-btn-ghost px-4 py-3">Carteirinha de vacina</a>
            <a href="{{ route('atendimentos.index') }}" class="vt-btn vt-btn-ghost px-4 py-3">Historico de atendimentos</a>
        </div>
    </section>
</div>
@endsection
