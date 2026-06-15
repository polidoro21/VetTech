@extends('layouts.dashboard')

@section('title', 'VetTech - Sala de Espera')
@section('page-title', 'Sala de Espera')
@section('page-subtitle', 'Fique disponivel, aceite atendimentos e acompanhe seu historico')

@section('content')
<div class="space-y-6">
    <section class="vt-card p-6">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div>
                <h2 class="font-display text-xl font-bold text-slate-950">Disponibilidade</h2>
                <p class="mt-1 text-sm text-slate-500">Quando voce fica disponivel, atendimentos abertos aparecem nesta fila.</p>
            </div>
            <form method="POST" action="{{ route('vet.disponibilidade') }}">
                @csrf
                <input type="hidden" name="disponivel_atendimento" value="{{ $user->disponivel_atendimento ? 0 : 1 }}">
                <button type="submit" class="vt-btn {{ $user->disponivel_atendimento ? 'vt-btn-danger' : 'vt-btn-accent' }} px-5 py-3">
                    <i data-lucide="{{ $user->disponivel_atendimento ? 'pause-circle' : 'play-circle' }}" class="h-4 w-4"></i>
                    {{ $user->disponivel_atendimento ? 'Ficar indisponivel' : 'Iniciar atendimentos' }}
                </button>
            </form>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1fr_.9fr]">
        <div class="vt-card p-6">
            <div class="mb-5 flex items-center justify-between">
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-950">Fila aberta</h2>
                    <p class="text-sm text-slate-400">{{ $fila->count() }} atendimento(s) disponivel(is)</p>
                </div>
                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $user->disponivel_atendimento ? 'bg-accent-light text-accent' : 'bg-slate-100 text-slate-500' }}">
                    {{ $user->disponivel_atendimento ? 'Disponivel' : 'Indisponivel' }}
                </span>
            </div>

            <div class="space-y-4">
                @forelse($fila as $atendimento)
                    @php($animal = $atendimento->animal)
                    @php($tutor = optional($animal)->usuario)
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                            <div>
                                <div class="flex flex-wrap items-center gap-2">
                                    <h3 class="text-lg font-extrabold text-slate-950">{{ $animal->nome ?? 'Pet' }}</h3>
                                    <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-brand">{{ ucfirst($atendimento->modo) }}</span>
                                </div>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $animal->especie ?? 'Especie nao informada' }}
                                    {{ $animal?->porte ? '· Porte '.$animal->porte : '' }}
                                    {{ $animal?->idade !== null ? '· '.$animal->idade.' anos' : '' }}
                                </p>
                                <p class="mt-1 text-sm text-slate-500">
                                    {{ $tutor->cidade ?: 'Cidade nao informada' }} {{ $tutor->uf ? '- '.$tutor->uf : '' }}
                                </p>
                                <p class="mt-3 text-sm text-slate-700">{{ $atendimento->descricao }}</p>
                            </div>
                            <div class="flex shrink-0 flex-wrap gap-2">
                                <form method="POST" action="{{ route('atendimentos.accept', $atendimento) }}">
                                    @csrf
                                    <button type="submit" class="vt-btn vt-btn-primary px-4 py-2 text-sm">Aceitar</button>
                                </form>
                                <form method="POST" action="{{ route('atendimentos.refuse', $atendimento) }}">
                                    @csrf
                                    <button type="submit" class="vt-btn vt-btn-ghost px-4 py-2 text-sm">Recusar</button>
                                </form>
                            </div>
                        </div>
                    </article>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-300 p-8 text-center text-slate-500">
                        <i data-lucide="inbox" class="mx-auto mb-3 h-10 w-10 text-slate-300"></i>
                        @if($user->disponivel_atendimento)
                            <p class="font-semibold">Nenhum atendimento na fila agora.</p>
                        @else
                            <p class="font-semibold">Fique disponivel para visualizar atendimentos abertos.</p>
                        @endif
                    </div>
                @endforelse
            </div>
        </div>

        <div class="vt-card p-6">
            <div class="mb-5">
                <h2 class="font-display text-lg font-bold text-slate-950">Meus atendimentos</h2>
                <p class="text-sm text-slate-400">Em andamento e finalizados por voce.</p>
            </div>
            <div class="space-y-3">
                @forelse($meusAtendimentos as $atendimento)
                    <a href="{{ route('atendimentos.show', $atendimento) }}" class="block rounded-2xl border border-slate-200 p-4 hover:bg-slate-50">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-bold text-slate-900">{{ $atendimento->animal->nome ?? 'Pet' }}</p>
                                <p class="text-sm text-slate-500">{{ $atendimento->created_at->format('d/m/Y H:i') }} · {{ ucfirst($atendimento->modo) }}</p>
                            </div>
                            <span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">{{ str_replace('_', ' ', $atendimento->status) }}</span>
                        </div>
                    </a>
                @empty
                    <p class="rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm font-semibold text-slate-500">Nenhum atendimento aceito ainda.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>

@if($user->disponivel_atendimento)
    @push('scripts')
        <script>
            setTimeout(() => window.location.reload(), 15000);
        </script>
    @endpush
@endif
@endsection
