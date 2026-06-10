@extends('layouts.dashboard')

@section('title', 'VetTech - '.$clinica->nome)
@section('page-title', $clinica->nome)
@section('page-subtitle', $clinica->tipo)

@section('content')
<div class="grid gap-6 lg:grid-cols-[1fr_.75fr]">
    <section class="vt-card p-6">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
            <div>
                <h2 class="font-display text-2xl font-bold text-slate-950">{{ $clinica->nome }}</h2>
                <p class="text-slate-500">{{ $clinica->endereco_completo ?: 'Atendimento online' }}</p>
            </div>
            <span class="w-fit rounded-full px-3 py-1 text-sm font-bold {{ $clinica->aberta_agora ? 'bg-accent-light text-accent' : 'bg-slate-100 text-slate-500' }}">
                {{ $clinica->aberta_agora ? 'Aberta agora' : 'Horario: '.$clinica->horario_abertura }}
            </span>
        </div>

        <p class="mt-5 leading-relaxed text-slate-600">{{ $clinica->descricao ?: 'Clinica cadastrada na rede VetTech.' }}</p>

        <dl class="mt-6 grid gap-4 sm:grid-cols-2">
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Telefone</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $clinica->telefone ?: 'Nao informado' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Email</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $clinica->email ?: 'Nao informado' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Avaliacao</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $clinica->nota ?: '-' }}</dd>
            </div>
            <div class="rounded-2xl bg-slate-50 p-4">
                <dt class="text-sm font-bold text-slate-400">Telemedicina</dt>
                <dd class="mt-1 font-semibold text-slate-900">{{ $clinica->telemedicina ? 'Disponivel' : 'Nao disponivel' }}</dd>
            </div>
        </dl>
    </section>

    <aside class="vt-card p-6">
        <h3 class="font-display text-lg font-bold text-slate-950">Agendamento</h3>
        <p class="mt-1 text-sm text-slate-500">Use esta clinica em uma nova consulta.</p>
        <div class="mt-5 grid gap-3">
            <a href="{{ route('consultas.create', ['clinica_id' => $clinica->id, 'tipo' => $clinica->telemedicina ? 'online' : 'presencial']) }}" class="vt-btn vt-btn-primary px-4 py-3">Agendar consulta</a>
            @if($clinica->telemedicina)
                <a href="{{ route('telemedicina.index') }}" class="vt-btn vt-btn-ghost px-4 py-3">Agendar telemedicina</a>
            @endif
            <a href="{{ route('clinicas.index') }}" class="vt-btn vt-btn-ghost px-4 py-3">Voltar</a>
        </div>
    </aside>
</div>
@endsection
