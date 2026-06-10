@extends('layouts.dashboard')

@section('title', 'VetTech - Carteirinha')
@section('page-title', 'Carteirinha de Vacina')
@section('page-subtitle', 'Controle as vacinas dos seus pets')

@section('content')
<div class="grid gap-6 xl:grid-cols-[.8fr_1.2fr]">
    <section class="vt-card p-6">
        <h2 class="font-display text-lg font-bold text-slate-950">Registrar vacina</h2>
        @if($animais->isEmpty())
            <div class="mt-4 rounded-2xl border border-dashed border-slate-300 p-6 text-center">
                <p class="font-semibold text-slate-600">Cadastre um pet antes de registrar vacinas.</p>
                <a href="{{ route('animais.create') }}" class="mt-4 inline-flex vt-btn vt-btn-primary px-4 py-2">Cadastrar pet</a>
            </div>
        @else
            <form action="{{ route('vacinas.store') }}" method="POST" class="mt-5 space-y-4">
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
                    <label class="vt-label" for="nome">Vacina</label>
                    <input id="nome" name="nome" class="vt-input" value="{{ old('nome') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="data_aplicacao">Data de aplicacao</label>
                    <input id="data_aplicacao" name="data_aplicacao" type="date" class="vt-input" value="{{ old('data_aplicacao') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="proxima_dose">Proxima dose</label>
                    <input id="proxima_dose" name="proxima_dose" type="date" class="vt-input" value="{{ old('proxima_dose') }}">
                </div>
                <button class="vt-btn vt-btn-primary w-full px-4 py-3" type="submit">Salvar vacina</button>
            </form>
        @endif
    </section>

    <section class="vt-card overflow-hidden">
        <div class="border-b border-slate-100 p-5">
            <h2 class="font-display text-lg font-bold text-slate-950">Historico</h2>
            <p class="text-sm text-slate-400">{{ $vacinas->count() }} registro(s)</p>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-extrabold uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3">Pet</th>
                        <th class="px-5 py-3">Vacina</th>
                        <th class="px-5 py-3">Aplicacao</th>
                        <th class="px-5 py-3">Proxima dose</th>
                        <th class="px-5 py-3 text-right">Acoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($vacinas as $vacina)
                        <tr>
                            <td class="px-5 py-4 font-bold text-slate-900">{{ $vacina->animal->nome ?? 'Pet' }}</td>
                            <td class="px-5 py-4">{{ $vacina->nome }}</td>
                            <td class="px-5 py-4">{{ $vacina->data_aplicacao->format('d/m/Y') }}</td>
                            <td class="px-5 py-4">{{ $vacina->proxima_dose ? $vacina->proxima_dose->format('d/m/Y') : 'Nao informada' }}</td>
                            <td class="px-5 py-4">
                                <form class="flex justify-end" method="POST" action="{{ route('vacinas.destroy', $vacina->id) }}" onsubmit="return confirm('Excluir esta vacina?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="vt-btn vt-btn-danger px-3 py-2 text-xs" type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-5 py-10 text-center text-sm font-semibold text-slate-500">Nenhuma vacina registrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </section>
</div>
@endsection
