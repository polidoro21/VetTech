@extends('layouts.dashboard')

@section('title', 'VetTech - Atendimentos')
@section('page-title', 'Atendimentos')
@section('page-subtitle', 'Fila, salas em andamento e resultados do seu pet')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-lg font-bold text-slate-950">Historico de atendimentos</h2>
            <p class="text-sm text-slate-400">{{ $atendimentos->count() }} atendimento(s)</p>
        </div>
        <a href="{{ route('atendimentos.create') }}" class="vt-btn vt-btn-primary px-4 py-2">
            <i data-lucide="plus" class="h-4 w-4"></i> Solicitar atendimento
        </a>
    </div>

    <div class="grid gap-4">
        @forelse($atendimentos as $atendimento)
            @php
                $statusClass = match($atendimento->status) {
                    'aguardando' => 'bg-warn-light text-warn',
                    'em_atendimento' => 'bg-brand-light text-brand',
                    'finalizado' => 'bg-accent-light text-accent',
                    'cancelado' => 'bg-slate-100 text-slate-500',
                    default => 'bg-slate-100 text-slate-500',
                };
            @endphp
            <article class="vt-card p-5">
                <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
                    <div class="min-w-0">
                        <div class="flex flex-wrap items-center gap-2">
                            <h3 class="text-lg font-extrabold text-slate-950">{{ $atendimento->animal->nome ?? 'Pet removido' }}</h3>
                            <span class="rounded-full px-3 py-1 text-xs font-bold {{ $statusClass }}">{{ str_replace('_', ' ', $atendimento->status) }}</span>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-bold text-slate-500">{{ ucfirst($atendimento->modo) }}</span>
                        </div>
                        <p class="mt-2 text-sm text-slate-500">
                            Criado em {{ $atendimento->created_at->format('d/m/Y H:i') }}
                            @if($atendimento->veterinario)
                                · Vet: {{ $atendimento->veterinario->name }}
                            @endif
                        </p>
                        <p class="mt-2 max-w-3xl text-sm text-slate-700">{{ $atendimento->descricao }}</p>
                    </div>
                    <div class="flex flex-wrap gap-2">
                        <a href="{{ route('atendimentos.show', $atendimento) }}" class="vt-btn vt-btn-primary px-4 py-2 text-sm">
                            {{ $atendimento->status === 'finalizado' ? 'Ver resultado' : 'Entrar' }}
                        </a>
                        @if(in_array($atendimento->status, ['aguardando', 'em_atendimento'], true))
                            <form method="POST" action="{{ route('atendimentos.cancel', $atendimento) }}" onsubmit="return confirm('Cancelar este atendimento?')">
                                @csrf
                                <button type="submit" class="vt-btn vt-btn-danger px-4 py-2 text-sm">Cancelar</button>
                            </form>
                        @endif
                    </div>
                </div>
            </article>
        @empty
            <div class="vt-card p-10 text-center">
                <i data-lucide="messages-square" class="mx-auto mb-3 h-12 w-12 text-slate-300"></i>
                <h2 class="font-display text-xl font-bold text-slate-950">Nenhum atendimento solicitado</h2>
                <p class="mt-1 text-sm text-slate-500">Quando precisar, solicite atendimento por chat ou video para entrar na fila.</p>
                <a href="{{ route('atendimentos.create') }}" class="mt-5 inline-flex vt-btn vt-btn-primary px-5 py-3">Solicitar agora</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
