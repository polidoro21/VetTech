@extends('layouts.dashboard')

@section('title', 'VetTech - Telemedicina')
@section('page-title', 'Telemedicina')
@section('page-subtitle', 'Consultas online para orientacao e retorno')

@section('content')
<div class="grid gap-6 xl:grid-cols-[.85fr_1.15fr]">
    <section class="vt-card p-6">
        <h2 class="font-display text-lg font-bold text-slate-950">Agendar consulta online</h2>
        @if($animais->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-slate-300 p-6 text-center">
                <p class="font-semibold text-slate-600">Cadastre um pet antes de usar telemedicina.</p>
                <a href="{{ route('animais.create') }}" class="mt-4 inline-flex vt-btn vt-btn-primary px-4 py-2">Cadastrar pet</a>
            </div>
        @else
            <form action="{{ route('telemedicina.store') }}" method="POST" class="mt-5 space-y-4">
                @csrf
                <div>
                    <label class="vt-label" for="animal_id">Pet</label>
                    <select id="animal_id" name="animal_id" class="vt-input" required>
                        <option value="">Selecione</option>
                        @foreach($animais as $animal)
                            <option value="{{ $animal->id }}" @selected((string) old('animal_id') === (string) $animal->id)>{{ $animal->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="clinica_id">Clinica online</label>
                    <select id="clinica_id" name="clinica_id" class="vt-input">
                        <option value="">Sem clinica definida</option>
                        @foreach($clinicas as $clinica)
                            <option value="{{ $clinica->id }}" @selected((string) old('clinica_id') === (string) $clinica->id)>{{ $clinica->nome }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="vt-label" for="veterinario">Veterinario</label>
                    <input id="veterinario" name="veterinario" class="vt-input" value="{{ old('veterinario') }}">
                </div>
                <div>
                    <label class="vt-label" for="especialidade">Especialidade</label>
                    <input id="especialidade" name="especialidade" class="vt-input" value="{{ old('especialidade', 'Teleorientacao') }}">
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div>
                        <label class="vt-label" for="data">Data</label>
                        <input id="data" name="data" type="date" class="vt-input" value="{{ old('data') }}" required>
                    </div>
                    <div>
                        <label class="vt-label" for="hora">Hora</label>
                        <input id="hora" name="hora" type="time" class="vt-input" value="{{ old('hora') }}">
                    </div>
                </div>
                <div>
                    <label class="vt-label" for="observacoes">Observacoes</label>
                    <textarea id="observacoes" name="observacoes" class="vt-input min-h-24">{{ old('observacoes') }}</textarea>
                </div>
                <button type="submit" class="vt-btn vt-btn-primary w-full px-4 py-3">Agendar online</button>
            </form>
        @endif
    </section>

    <section class="vt-card overflow-hidden">
        <div class="border-b border-slate-100 p-5">
            <h2 class="font-display text-lg font-bold text-slate-950">Consultas online</h2>
            <p class="text-sm text-slate-400">{{ $consultas->count() }} agendamento(s)</p>
        </div>
        <div class="divide-y divide-slate-100">
            @forelse($consultas as $consulta)
                <div class="p-5">
                    <div class="flex flex-col gap-3 sm:flex-row sm:items-start sm:justify-between">
                        <div>
                            <p class="font-bold text-slate-950">{{ $consulta->animal->nome ?? 'Pet' }}</p>
                            <p class="text-sm text-slate-500">{{ $consulta->data->format('d/m/Y') }} {{ $consulta->hora ? substr($consulta->hora, 0, 5) : '' }}</p>
                            <p class="text-sm text-slate-500">{{ $consulta->clinica->nome ?? 'Clinica nao definida' }}</p>
                        </div>
                        <a href="{{ $consulta->sala_url ?: route('telemedicina.sala', $consulta->id) }}" class="vt-btn vt-btn-primary px-4 py-2 text-sm">Entrar na sala</a>
                    </div>
                </div>
            @empty
                <div class="p-10 text-center text-sm font-semibold text-slate-500">Nenhuma consulta online agendada.</div>
            @endforelse
        </div>
    </section>
</div>
@endsection
