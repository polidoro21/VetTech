@extends('layouts.dashboard')

@section('title', 'VetTech - Clinicas')
@section('page-title', 'Clinicas')
@section('page-subtitle', 'Busque locais para atendimento presencial ou online')

@section('content')
<div class="space-y-5">
    <form action="{{ route('clinicas.buscar') }}" method="GET" class="vt-card p-4">
        <div class="flex flex-col gap-3 md:flex-row">
            <div class="flex-1">
                <label class="vt-label" for="busca">Buscar por nome, cidade, bairro ou tipo</label>
                <input id="busca" name="busca" class="vt-input" value="{{ $busca ?? '' }}" placeholder="Ex: Paulista, online, emergencia">
            </div>
            <div class="flex items-end">
                <button class="vt-btn vt-btn-primary w-full px-5 py-3 md:w-auto" type="submit">
                    <i data-lucide="search" class="h-4 w-4"></i> Buscar
                </button>
            </div>
        </div>
    </form>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($clinicas as $clinica)
            <article class="vt-card p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h2 class="text-lg font-extrabold text-slate-950">{{ $clinica->nome }}</h2>
                        <p class="text-sm text-slate-500">{{ $clinica->tipo }}</p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-bold {{ $clinica->aberta_agora ? 'bg-accent-light text-accent' : 'bg-slate-100 text-slate-500' }}">
                        {{ $clinica->aberta_agora ? 'Aberta' : 'Consultar horario' }}
                    </span>
                </div>

                <div class="mt-4 space-y-2 text-sm text-slate-600">
                    <p class="flex gap-2"><i data-lucide="map-pin" class="mt-0.5 h-4 w-4 text-brand"></i> {{ $clinica->endereco_completo ?: 'Atendimento online' }}</p>
                    <p class="flex gap-2"><i data-lucide="phone" class="mt-0.5 h-4 w-4 text-brand"></i> {{ $clinica->telefone ?: 'Telefone nao informado' }}</p>
                    <p class="flex gap-2"><i data-lucide="star" class="mt-0.5 h-4 w-4 text-amber-500"></i> Nota {{ $clinica->nota ?? '-' }} {{ $clinica->distancia !== null ? '- '.$clinica->distancia.' km' : '' }}</p>
                </div>

                <div class="mt-5 flex gap-2">
                    <a href="{{ route('clinicas.show', $clinica->id) }}" class="vt-btn vt-btn-ghost flex-1 px-3 py-2 text-sm">Detalhes</a>
                    <a href="{{ route('consultas.create', ['clinica_id' => $clinica->id, 'tipo' => $clinica->telemedicina ? 'online' : 'presencial']) }}" class="vt-btn vt-btn-primary flex-1 px-3 py-2 text-sm">Agendar</a>
                </div>
            </article>
        @empty
            <div class="vt-card col-span-full p-10 text-center">
                <i data-lucide="building-2" class="mx-auto mb-3 h-12 w-12 text-slate-300"></i>
                <h2 class="font-display text-xl font-bold text-slate-950">Nenhuma clinica encontrada</h2>
                <p class="mt-1 text-sm text-slate-500">Tente buscar por outro termo.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection
