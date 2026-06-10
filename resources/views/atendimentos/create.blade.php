@extends('layouts.dashboard')

@section('title', 'VetTech - Novo Atendimento')
@section('page-title', 'Novo Atendimento')
@section('page-subtitle', 'Registre um historico clinico do pet')

@section('content')
<div class="vt-card max-w-3xl p-6">
    @if($animais->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 p-8 text-center">
            <p class="font-bold text-slate-700">Cadastre um pet antes de registrar atendimentos.</p>
            <a href="{{ route('animais.create') }}" class="mt-4 inline-flex vt-btn vt-btn-primary px-4 py-2">Cadastrar pet</a>
        </div>
    @else
        <form action="{{ route('atendimentos.store') }}" method="POST" class="space-y-5">
            @csrf
            <div class="grid gap-5 md:grid-cols-2">
                <div>
                    <label class="vt-label" for="animal_id">Pet</label>
                    <select id="animal_id" name="animal_id" class="vt-input" required>
                        <option value="">Selecione</option>
                        @foreach($animais as $animal)
                            <option value="{{ $animal->id }}" @selected((string) old('animal_id', request('animal_id')) === (string) $animal->id)>{{ $animal->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="data">Data</label>
                    <input id="data" name="data" type="date" class="vt-input" value="{{ old('data') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="valor">Valor</label>
                    <input id="valor" name="valor" type="number" step="0.01" min="0" class="vt-input" value="{{ old('valor') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="status">Status</label>
                    <select id="status" name="status" class="vt-input">
                        <option value="nao_atendido" @selected(old('status') === 'nao_atendido')>Nao atendido</option>
                        <option value="atendido" @selected(old('status') === 'atendido')>Atendido</option>
                    </select>
                </div>
                <div class="md:col-span-2">
                    <label class="vt-label" for="descricao">Descricao</label>
                    <textarea id="descricao" name="descricao" class="vt-input min-h-28" required>{{ old('descricao') }}</textarea>
                </div>
                <div class="md:col-span-2">
                    <label class="vt-label" for="observacoes">Observacoes</label>
                    <textarea id="observacoes" name="observacoes" class="vt-input min-h-24">{{ old('observacoes') }}</textarea>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="vt-btn vt-btn-primary px-5 py-3">Salvar atendimento</button>
                <a href="{{ route('atendimentos.index') }}" class="vt-btn vt-btn-ghost px-5 py-3">Cancelar</a>
            </div>
        </form>
    @endif
</div>
@endsection
