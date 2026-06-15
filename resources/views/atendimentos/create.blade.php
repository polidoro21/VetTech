@extends('layouts.dashboard')

@section('title', 'VetTech - Solicitar Atendimento')
@section('page-title', 'Solicitar Atendimento')
@section('page-subtitle', 'Entre na fila para falar com um veterinario')

@section('content')
<div class="grid gap-6 lg:grid-cols-[.85fr_1.15fr]">
    <section class="vt-card p-6">
        <h2 class="font-display text-lg font-bold text-slate-950">Novo atendimento</h2>
        <p class="mt-1 text-sm text-slate-500">Descreva o que esta acontecendo para o veterinario avaliar antes de aceitar.</p>

        @if($animais->isEmpty())
            <div class="mt-5 rounded-2xl border border-dashed border-slate-300 p-8 text-center">
                <p class="font-bold text-slate-700">Cadastre um pet antes de solicitar atendimento.</p>
                <a href="{{ route('animais.create') }}" class="mt-4 inline-flex vt-btn vt-btn-primary px-4 py-2">Cadastrar pet</a>
            </div>
        @else
            <form action="{{ route('atendimentos.store') }}" method="POST" class="mt-5 space-y-5">
                @csrf
                <div>
                    <label class="vt-label" for="animal_id">Pet</label>
                    <select id="animal_id" name="animal_id" class="vt-input" required>
                        <option value="">Selecione</option>
                        @foreach($animais as $animal)
                            <option value="{{ $animal->id }}" @selected((string) old('animal_id', request('animal_id')) === (string) $animal->id)>{{ $animal->nome }} · {{ $animal->especie }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="modo">Tipo de interacao</label>
                    <select id="modo" name="modo" class="vt-input" required>
                        <option value="chat" @selected(old('modo') === 'chat')>Chat</option>
                        <option value="video" @selected(old('modo') === 'video')>Chamada de video</option>
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="descricao">O que esta acontecendo?</label>
                    <textarea id="descricao" name="descricao" class="vt-input min-h-36" required placeholder="Conte sintomas, comportamento, tempo de evolucao e qualquer informacao importante.">{{ old('descricao') }}</textarea>
                </div>
                <div>
                    <label class="vt-label" for="observacoes">Observacoes adicionais</label>
                    <textarea id="observacoes" name="observacoes" class="vt-input min-h-24">{{ old('observacoes') }}</textarea>
                </div>
                <div class="flex flex-wrap gap-3 pt-2">
                    <button type="submit" class="vt-btn vt-btn-primary px-5 py-3">Entrar na fila</button>
                    <a href="{{ route('atendimentos.index') }}" class="vt-btn vt-btn-ghost px-5 py-3">Cancelar</a>
                </div>
            </form>
        @endif
    </section>

    <aside class="vt-card p-6">
        <h3 class="font-display text-lg font-bold text-slate-950">Como funciona</h3>
        <div class="mt-5 space-y-4">
            <div class="flex gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-brand-light text-brand">
                    <i data-lucide="list-plus" class="h-4 w-4"></i>
                </div>
                <div>
                    <p class="font-bold text-slate-900">Voce entra na fila</p>
                    <p class="text-sm text-slate-500">Veterinarios disponiveis recebem os dados nao sensiveis do pet.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-accent-light text-accent">
                    <i data-lucide="stethoscope" class="h-4 w-4"></i>
                </div>
                <div>
                    <p class="font-bold text-slate-900">Um vet aceita</p>
                    <p class="text-sm text-slate-500">Quando aceitar, a sala compartilhada abre para voces dois.</p>
                </div>
            </div>
            <div class="flex gap-3">
                <div class="flex h-9 w-9 shrink-0 items-center justify-center rounded-xl bg-warn-light text-warn">
                    <i data-lucide="file-heart" class="h-4 w-4"></i>
                </div>
                <div>
                    <p class="font-bold text-slate-900">Resultado salvo</p>
                    <p class="text-sm text-slate-500">Ao finalizar, voce recebe anotacoes, descricao do observado e receita anexada.</p>
                </div>
            </div>
        </div>
    </aside>
</div>
@endsection
