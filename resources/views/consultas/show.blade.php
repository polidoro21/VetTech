@extends('layouts.dashboard')

@section('title', 'VetTech - Consulta')
@section('page-title', 'Detalhe da Consulta')
@section('page-subtitle', $consulta->animal->nome ?? 'Consulta')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1fr_.75fr]">
    <section class="vt-card p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h2 class="font-display text-2xl font-bold text-slate-950">{{ $consulta->animal->nome ?? 'Pet' }}</h2>
                <p class="text-slate-500">{{ ucfirst($consulta->tipo) }} - {{ $consulta->especialidade ?: 'Clinica Geral' }}</p>
            </div>
            <span class="w-fit rounded-full bg-brand-light px-3 py-1 text-sm font-bold text-brand">{{ $consulta->status }}</span>
        </div>

        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Data</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $consulta->data->format('d/m/Y') }} {{ $consulta->hora ? substr($consulta->hora, 0, 5) : '' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Clinica</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $consulta->clinica->nome ?? 'Nao definida' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Veterinario</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $consulta->veterinario ?: 'Nao definido' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Valor</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $consulta->valor !== null ? 'R$ '.number_format($consulta->valor, 2, ',', '.') : 'Nao informado' }}</dd>
            </div>
        </dl>

        @if($consulta->observacoes)
            <div class="mt-5 rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-400">Observacoes</p>
                <p class="mt-1 text-slate-700">{{ $consulta->observacoes }}</p>
            </div>
        @endif
    </section>

    <aside class="vt-card p-6">
        <h3 class="font-display text-lg font-bold text-slate-950">Acoes</h3>
        <div class="mt-4 grid gap-3">
            @if($consulta->tipo === 'online' && $consulta->sala_url)
                <a href="{{ $consulta->sala_url }}" class="vt-btn vt-btn-primary px-4 py-3">Entrar na sala online</a>
            @endif
            <a href="{{ route('consultas.index') }}" class="vt-btn vt-btn-ghost px-4 py-3">Voltar para agenda</a>
            <form method="POST" action="{{ route('consultas.destroy', $consulta->id) }}" onsubmit="return confirm('Remover esta consulta?')">
                @csrf
                @method('DELETE')
                <button type="submit" class="vt-btn vt-btn-danger w-full px-4 py-3">Excluir consulta</button>
            </form>
        </div>
    </aside>
</div>
@endsection
