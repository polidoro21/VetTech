@extends('layouts.dashboard')

@section('title', 'VetTech - Aprovacao de Clinicas')
@section('page-title', 'Aprovacao de Clinicas')
@section('page-subtitle', 'Revise novos cadastros e alteracoes pendentes')

@section('content')
<div class="space-y-5">
    @forelse($clinicas as $clinica)
        @php
            $changes = $clinica->pending_changes ?? [];
            $needsReview = $clinica->status !== 'approved' || !empty($changes);
        @endphp
        <article class="vt-card p-6">
            <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                <div>
                    <div class="flex flex-wrap items-center gap-2">
                        <h2 class="font-display text-xl font-bold text-slate-950">{{ $changes['nome'] ?? $clinica->nome }}</h2>
                        <span class="rounded-full px-3 py-1 text-xs font-bold {{ $needsReview ? 'bg-warn-light text-warn' : 'bg-accent-light text-accent' }}">
                            {{ !empty($changes) ? 'alteracoes pendentes' : $clinica->status }}
                        </span>
                    </div>
                    <p class="mt-1 text-sm text-slate-500">Usuario: {{ $clinica->user->name ?? 'Sem usuario vinculado' }} · {{ $clinica->user->email ?? $clinica->email }}</p>
                    <p class="mt-3 max-w-3xl text-sm text-slate-700">{{ $changes['descricao'] ?? $clinica->descricao ?? 'Sem descricao.' }}</p>
                </div>
                @if($needsReview)
                    <div class="flex shrink-0 flex-wrap gap-2">
                        <form method="POST" action="{{ route('admin.clinicas.approve', $clinica) }}">
                            @csrf
                            <button type="submit" class="vt-btn vt-btn-accent px-4 py-2 text-sm">Aprovar</button>
                        </form>
                        <form method="POST" action="{{ route('admin.clinicas.reject', $clinica) }}" class="flex gap-2">
                            @csrf
                            <input name="rejection_reason" class="vt-input h-10 min-w-48 py-2 text-sm" placeholder="Motivo opcional">
                            <button type="submit" class="vt-btn vt-btn-danger px-4 py-2 text-sm">Rejeitar</button>
                        </form>
                    </div>
                @endif
            </div>

            <dl class="mt-5 grid gap-3 md:grid-cols-3">
                <div class="rounded-2xl bg-slate-50 p-4">
                    <dt class="text-xs font-bold uppercase text-slate-400">Contato</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $changes['telefone'] ?? $clinica->telefone ?? 'Nao informado' }}</dd>
                    <dd class="text-sm text-slate-500">{{ $changes['email'] ?? $clinica->email ?? 'Sem email publico' }}</dd>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <dt class="text-xs font-bold uppercase text-slate-400">Endereco</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $changes['cidade'] ?? $clinica->cidade ?? 'Cidade nao informada' }} {{ ($changes['uf'] ?? $clinica->uf) ? '- '.($changes['uf'] ?? $clinica->uf) : '' }}</dd>
                    <dd class="text-sm text-slate-500">{{ $changes['bairro'] ?? $clinica->bairro ?? 'Bairro nao informado' }}</dd>
                </div>
                <div class="rounded-2xl bg-slate-50 p-4">
                    <dt class="text-xs font-bold uppercase text-slate-400">Horario</dt>
                    <dd class="mt-1 text-sm font-semibold text-slate-800">{{ $changes['horario_abertura'] ?? $clinica->horario_abertura ?? 'Nao informado' }}</dd>
                    <dd class="text-sm text-slate-500">{{ ($changes['telemedicina'] ?? $clinica->telemedicina) ? 'Aceita remoto' : 'Remoto nao marcado' }}</dd>
                </div>
            </dl>
        </article>
    @empty
        <div class="vt-card p-10 text-center">
            <i data-lucide="shield-check" class="mx-auto mb-3 h-12 w-12 text-slate-300"></i>
            <h2 class="font-display text-xl font-bold text-slate-950">Nenhuma clinica cadastrada</h2>
        </div>
    @endforelse
</div>
@endsection
