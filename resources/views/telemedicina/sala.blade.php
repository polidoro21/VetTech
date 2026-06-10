@extends('layouts.dashboard')

@section('title', 'VetTech - Sala Online')
@section('page-title', 'Sala Online')
@section('page-subtitle', $consulta->animal->nome ?? 'Consulta online')

@section('content')
<div class="grid gap-6 lg:grid-cols-[1fr_.75fr]">
    <section class="vt-card p-6">
        <div class="flex min-h-[360px] flex-col items-center justify-center rounded-2xl bg-slate-950 p-8 text-center text-white">
            <i data-lucide="video" class="mb-4 h-14 w-14 text-accent"></i>
            <h2 class="font-display text-2xl font-bold">Sala de telemedicina</h2>
            <p class="mt-2 max-w-md text-slate-300">Este e o espaco reservado para a consulta online. A integracao com video chamada pode ser conectada aqui depois.</p>
            <span class="mt-5 rounded-full bg-accent px-4 py-2 text-sm font-bold">Status: {{ $consulta->status }}</span>
        </div>
    </section>

    <aside class="vt-card p-6">
        <h3 class="font-display text-lg font-bold text-slate-950">Detalhes</h3>
        <dl class="mt-4 space-y-3 text-sm">
            <div class="rounded-xl bg-slate-50 p-3">
                <dt class="font-bold text-slate-400">Pet</dt>
                <dd class="font-semibold text-slate-900">{{ $consulta->animal->nome ?? 'Pet' }}</dd>
            </div>
            <div class="rounded-xl bg-slate-50 p-3">
                <dt class="font-bold text-slate-400">Data</dt>
                <dd class="font-semibold text-slate-900">{{ $consulta->data->format('d/m/Y') }} {{ $consulta->hora ? substr($consulta->hora, 0, 5) : '' }}</dd>
            </div>
            <div class="rounded-xl bg-slate-50 p-3">
                <dt class="font-bold text-slate-400">Clinica</dt>
                <dd class="font-semibold text-slate-900">{{ $consulta->clinica->nome ?? 'Nao definida' }}</dd>
            </div>
        </dl>
        <a href="{{ route('telemedicina.index') }}" class="mt-5 flex vt-btn vt-btn-ghost px-4 py-3">Voltar</a>
    </aside>
</div>
@endsection
