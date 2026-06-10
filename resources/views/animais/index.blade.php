@extends('layouts.dashboard')

@section('title', 'VetTech - Meus Pets')
@section('page-title', 'Meus Pets')
@section('page-subtitle', 'Cadastre e acompanhe seus animais')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-lg font-bold text-slate-950">Animais cadastrados</h2>
            <p class="text-sm text-slate-400">{{ $pets->count() }} pet(s) na sua conta</p>
        </div>
        <a href="{{ route('animais.create') }}" class="vt-btn vt-btn-primary px-4 py-2">
            <i data-lucide="plus" class="h-4 w-4"></i> Novo Pet
        </a>
    </div>

    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
        @forelse($pets as $pet)
            <article class="vt-card p-5">
                <div class="flex items-start justify-between gap-3">
                    <div>
                        <h3 class="text-xl font-extrabold text-slate-950">{{ $pet->nome }}</h3>
                        <p class="text-sm text-slate-500">{{ $pet->especie }} {{ $pet->raca ? '- '.$pet->raca : '' }}</p>
                    </div>
                    <span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">{{ ucfirst($pet->porte) }}</span>
                </div>

                <dl class="mt-5 grid grid-cols-2 gap-3 text-sm">
                    <div class="rounded-xl bg-slate-50 p-3">
                        <dt class="font-bold text-slate-400">Idade</dt>
                        <dd class="font-semibold text-slate-800">{{ $pet->idade !== null ? $pet->idade.' anos' : 'Nao informada' }}</dd>
                    </div>
                    <div class="rounded-xl bg-slate-50 p-3">
                        <dt class="font-bold text-slate-400">Cor</dt>
                        <dd class="font-semibold text-slate-800">{{ $pet->cor ?: 'Nao informada' }}</dd>
                    </div>
                </dl>

                <div class="mt-5 flex flex-wrap gap-2">
                    <a href="{{ route('animais.show', $pet->id) }}" class="vt-btn vt-btn-ghost flex-1 px-3 py-2 text-sm">Ver</a>
                    <a href="{{ route('animais.edit', $pet->id) }}" class="vt-btn vt-btn-primary flex-1 px-3 py-2 text-sm">Editar</a>
                    <form action="{{ route('animais.destroy', $pet->id) }}" method="POST" onsubmit="return confirm('Excluir este pet?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="vt-btn vt-btn-danger px-3 py-2 text-sm">
                            <i data-lucide="trash-2" class="h-4 w-4"></i>
                        </button>
                    </form>
                </div>
            </article>
        @empty
            <div class="vt-card col-span-full p-10 text-center">
                <i data-lucide="paw-print" class="mx-auto mb-3 h-12 w-12 text-slate-300"></i>
                <h3 class="font-display text-xl font-bold text-slate-900">Nenhum pet cadastrado</h3>
                <p class="mt-1 text-sm text-slate-500">Comece adicionando o primeiro animal.</p>
                <a href="{{ route('animais.create') }}" class="mt-5 inline-flex vt-btn vt-btn-primary px-4 py-2">Cadastrar pet</a>
            </div>
        @endforelse
    </div>
</div>
@endsection
