@extends('layouts.dashboard')

@section('title', 'VetTech - Consultas')
@section('page-title', 'Consultas')
@section('page-subtitle', 'Agenda presencial e online')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-lg font-bold text-slate-950">Agenda</h2>
            <p class="text-sm text-slate-400">{{ $consultas->count() }} consulta(s) cadastrada(s)</p>
        </div>
        <a href="{{ route('consultas.create') }}" class="vt-btn vt-btn-primary px-4 py-2">
            <i data-lucide="calendar-plus" class="h-4 w-4"></i> Nova consulta
        </a>
    </div>

    <div class="vt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-extrabold uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3">Pet</th>
                        <th class="px-5 py-3">Tipo</th>
                        <th class="px-5 py-3">Data</th>
                        <th class="px-5 py-3">Clinica</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Acoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($consultas as $consulta)
                        <tr>
                            <td class="px-5 py-4 font-bold text-slate-900">{{ $consulta->animal->nome ?? 'Pet removido' }}</td>
                            <td class="px-5 py-4">{{ ucfirst($consulta->tipo) }}</td>
                            <td class="px-5 py-4">{{ $consulta->data->format('d/m/Y') }} {{ $consulta->hora ? substr($consulta->hora, 0, 5) : '' }}</td>
                            <td class="px-5 py-4">{{ $consulta->clinica->nome ?? 'Nao definida' }}</td>
                            <td class="px-5 py-4">
                                <span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">{{ $consulta->status }}</span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex justify-end gap-2">
                                    <a href="{{ route('consultas.show', $consulta->id) }}" class="vt-btn vt-btn-ghost px-3 py-2 text-xs">Ver</a>
                                    <form method="POST" action="{{ route('consultas.destroy', $consulta->id) }}" onsubmit="return confirm('Remover esta consulta?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="vt-btn vt-btn-danger px-3 py-2 text-xs">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm font-semibold text-slate-500">Nenhuma consulta cadastrada.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
