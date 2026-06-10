@extends('layouts.dashboard')

@section('title', 'VetTech - Atendimentos')
@section('page-title', 'Atendimentos')
@section('page-subtitle', 'Historico de atendimentos realizados ou pendentes')

@section('content')
<div class="space-y-5">
    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
        <div>
            <h2 class="font-display text-lg font-bold text-slate-950">Historico</h2>
            <p class="text-sm text-slate-400">{{ $atendimentos->count() }} atendimento(s)</p>
        </div>
        <a href="{{ route('atendimentos.create') }}" class="vt-btn vt-btn-primary px-4 py-2">
            <i data-lucide="plus" class="h-4 w-4"></i> Novo atendimento
        </a>
    </div>

    <div class="vt-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-slate-200 text-sm">
                <thead class="bg-slate-50 text-left text-xs font-extrabold uppercase tracking-wide text-slate-400">
                    <tr>
                        <th class="px-5 py-3">Pet</th>
                        <th class="px-5 py-3">Data</th>
                        <th class="px-5 py-3">Descricao</th>
                        <th class="px-5 py-3">Valor</th>
                        <th class="px-5 py-3">Status</th>
                        <th class="px-5 py-3 text-right">Acoes</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($atendimentos as $atendimento)
                        <tr>
                            <td class="px-5 py-4 font-bold text-slate-900">{{ $atendimento->animal->nome ?? 'Pet' }}</td>
                            <td class="px-5 py-4">{{ \Carbon\Carbon::parse($atendimento->data)->format('d/m/Y') }}</td>
                            <td class="px-5 py-4">{{ $atendimento->descricao }}</td>
                            <td class="px-5 py-4">R$ {{ number_format($atendimento->valor, 2, ',', '.') }}</td>
                            <td class="px-5 py-4">
                                <span class="rounded-full px-3 py-1 text-xs font-bold {{ $atendimento->status === 'atendido' ? 'bg-accent-light text-accent' : 'bg-warn-light text-warn' }}">
                                    {{ $atendimento->status === 'atendido' ? 'Atendido' : 'Nao atendido' }}
                                </span>
                            </td>
                            <td class="px-5 py-4">
                                <div class="flex flex-wrap justify-end gap-2">
                                    <form method="POST" action="{{ route('atendimentos.status', $atendimento->id) }}">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" value="{{ $atendimento->status === 'atendido' ? 'nao_atendido' : 'atendido' }}">
                                        <button type="submit" class="vt-btn vt-btn-ghost px-3 py-2 text-xs">
                                            {{ $atendimento->status === 'atendido' ? 'Marcar pendente' : 'Marcar atendido' }}
                                        </button>
                                    </form>
                                    <form method="POST" action="{{ route('atendimentos.destroy', $atendimento->id) }}" onsubmit="return confirm('Excluir este atendimento?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="vt-btn vt-btn-danger px-3 py-2 text-xs">Excluir</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="px-5 py-10 text-center text-sm font-semibold text-slate-500">Nenhum atendimento cadastrado.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
