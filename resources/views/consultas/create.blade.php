@extends('layouts.dashboard')

@section('title', 'VetTech - Nova Consulta')
@section('page-title', 'Nova Consulta')
@section('page-subtitle', 'Agende atendimento presencial ou online')

@section('content')
<div class="vt-card max-w-4xl p-6">
    @if($animais->isEmpty())
        <div class="rounded-2xl border border-dashed border-slate-300 p-8 text-center">
            <p class="font-bold text-slate-700">Cadastre um pet antes de agendar consultas.</p>
            <a href="{{ route('animais.create') }}" class="mt-4 inline-flex vt-btn vt-btn-primary px-4 py-2">Cadastrar pet</a>
        </div>
    @else
        <form action="{{ route('consultas.store') }}" method="POST" class="space-y-5">
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
                    <label class="vt-label" for="tipo">Tipo</label>
                    <select id="tipo" name="tipo" class="vt-input" required>
                        <option value="presencial" @selected(old('tipo', request('tipo', 'presencial')) === 'presencial')>Presencial</option>
                        <option value="online" @selected(old('tipo', request('tipo')) === 'online')>Online</option>
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="clinica_id">Clinica</label>
                    <select id="clinica_id" name="clinica_id" class="vt-input">
                        <option value="">Sem clinica definida</option>
                        @foreach($clinicas as $clinica)
                            <option value="{{ $clinica->id }}" @selected((string) old('clinica_id', request('clinica_id')) === (string) $clinica->id)>{{ $clinica->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="veterinario">Veterinario</label>
                    <input id="veterinario" name="veterinario" class="vt-input" value="{{ old('veterinario') }}">
                </div>
                <div>
                    <label class="vt-label" for="especialidade">Especialidade</label>
                    <input id="especialidade" name="especialidade" class="vt-input" value="{{ old('especialidade', 'Clinica Geral') }}">
                </div>
                <div>
                    <label class="vt-label" for="valor">Valor</label>
                    <input id="valor" name="valor" type="number" step="0.01" min="0" class="vt-input" value="{{ old('valor') }}">
                </div>
                <div>
                    <label class="vt-label" for="data">Data</label>
                    <input id="data" name="data" type="date" class="vt-input" value="{{ old('data') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="hora">Hora</label>
                    <input id="hora" name="hora" type="time" class="vt-input" value="{{ old('hora') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="vt-label" for="observacoes">Observacoes</label>
                    <textarea id="observacoes" name="observacoes" class="vt-input min-h-28">{{ old('observacoes') }}</textarea>
                </div>
            </div>
            <div class="flex flex-wrap gap-3 pt-2">
                <button type="submit" class="vt-btn vt-btn-primary px-5 py-3">Agendar consulta</button>
                <a href="{{ route('consultas.index') }}" class="vt-btn vt-btn-ghost px-5 py-3">Cancelar</a>
            </div>
        </form>
    @endif
</div>
@endsection
