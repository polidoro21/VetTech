@extends('layouts.dashboard')

@section('title', 'VetTech - Dashboard')
@section('page-title', 'Dashboard')
@section('page-subtitle', 'Resumo dos seus pets, consultas e cuidados recentes')

@section('content')
<div class="space-y-6">
    <section class="grid gap-4 md:grid-cols-3">
        <div class="vt-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-slate-400">Pets cadastrados</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-950">{{ $totalAnimais }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-brand-light text-brand">
                    <i data-lucide="paw-print" class="h-6 w-6"></i>
                </div>
            </div>
        </div>
        <div class="vt-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-slate-400">Consultas</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-950">{{ $totalConsultas }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-accent-light text-accent">
                    <i data-lucide="calendar-days" class="h-6 w-6"></i>
                </div>
            </div>
        </div>
        <div class="vt-card p-5">
            <div class="flex items-center justify-between">
                <div>
                    <p class="text-sm font-bold text-slate-400">Clinicas disponiveis</p>
                    <p class="mt-2 text-3xl font-extrabold text-slate-950">{{ $totalClinicas }}</p>
                </div>
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-warn-light text-warn">
                    <i data-lucide="building-2" class="h-6 w-6"></i>
                </div>
            </div>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-[1.4fr_.9fr]">
        <div class="vt-card p-5">
            <div class="mb-4 flex items-center justify-between gap-3">
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-950">Meus Pets</h2>
                    <p class="text-sm text-slate-400">Acompanhe os animais vinculados a sua conta.</p>
                </div>
                <a href="{{ route('animais.create') }}" class="vt-btn vt-btn-primary px-4 py-2 text-sm">
                    <i data-lucide="plus" class="h-4 w-4"></i> Novo pet
                </a>
            </div>

            <div class="grid gap-4 md:grid-cols-2">
                @forelse($animais as $animal)
                    <article class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <h3 class="text-lg font-extrabold text-slate-900">{{ $animal->nome }}</h3>
                                <p class="text-sm text-slate-500">{{ $animal->especie }} {{ $animal->raca ? '- '.$animal->raca : '' }}</p>
                            </div>
                            <span class="rounded-full bg-white px-3 py-1 text-xs font-bold text-brand">{{ ucfirst($animal->porte) }}</span>
                        </div>
                        <div class="mt-4 flex flex-wrap gap-2 text-xs font-semibold text-slate-500">
                            <span class="rounded-full bg-white px-3 py-1">{{ $animal->idade !== null ? $animal->idade.' anos' : 'Idade nao informada' }}</span>
                            <span class="rounded-full bg-white px-3 py-1">{{ $animal->cor ?: 'Cor nao informada' }}</span>
                        </div>
                        <div class="mt-4 flex gap-2">
                            <a href="{{ route('animais.show', $animal->id) }}" class="vt-btn vt-btn-ghost flex-1 px-3 py-2 text-sm">Ver</a>
                            <a href="{{ route('animais.edit', $animal->id) }}" class="vt-btn vt-btn-primary flex-1 px-3 py-2 text-sm">Editar</a>
                        </div>
                    </article>
                @empty
                    <div class="col-span-full rounded-2xl border border-dashed border-slate-300 p-8 text-center">
                        <i data-lucide="paw-print" class="mx-auto mb-3 h-10 w-10 text-slate-300"></i>
                        <p class="font-bold text-slate-600">Nenhum pet cadastrado ainda.</p>
                        <a href="{{ route('animais.create') }}" class="mt-4 inline-flex vt-btn vt-btn-primary px-4 py-2 text-sm">Cadastrar primeiro pet</a>
                    </div>
                @endforelse
            </div>
        </div>

        <div class="vt-card p-5">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-950">Proximas consultas</h2>
                    <p class="text-sm text-slate-400">Agenda presencial e online.</p>
                </div>
                <a href="{{ route('consultas.create') }}" class="text-sm font-bold text-brand hover:underline">Agendar</a>
            </div>
            <div class="space-y-3">
                @forelse($consultas as $consulta)
                    <a href="{{ route('consultas.show', $consulta->id) }}" class="block rounded-2xl border border-slate-200 p-4 hover:bg-slate-50">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="font-bold text-slate-900">{{ $consulta->animal->nome ?? 'Pet' }}</p>
                                <p class="text-sm text-slate-500">{{ ucfirst($consulta->tipo) }} {{ $consulta->clinica ? '- '.$consulta->clinica->nome : '' }}</p>
                            </div>
                            <span class="rounded-full bg-brand-light px-3 py-1 text-xs font-bold text-brand">{{ $consulta->status }}</span>
                        </div>
                        <p class="mt-2 text-sm font-semibold text-slate-700">
                            {{ $consulta->data->format('d/m/Y') }} {{ $consulta->hora ? 'as '.substr($consulta->hora, 0, 5) : '' }}
                        </p>
                    </a>
                @empty
                    <p class="rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm font-semibold text-slate-500">Nenhuma consulta agendada.</p>
                @endforelse
            </div>
        </div>
    </section>

    <section class="grid gap-6 xl:grid-cols-2">
        <div class="vt-card p-5">
            <div class="mb-4 flex items-center justify-between">
                <div>
                    <h2 class="font-display text-lg font-bold text-slate-950">Clinicas proximas</h2>
                    <p class="text-sm text-slate-400">Dados cadastrados para busca e agendamento.</p>
                </div>
                <a href="{{ route('clinicas.index') }}" class="text-sm font-bold text-brand hover:underline">Ver todas</a>
            </div>
            <div class="grid gap-3 sm:grid-cols-2">
                @forelse($clinicas as $clinica)
                    <a href="{{ route('clinicas.show', $clinica->id) }}" class="rounded-2xl border border-slate-200 p-4 hover:bg-slate-50">
                        <p class="font-bold text-slate-900">{{ $clinica->nome }}</p>
                        <p class="mt-1 text-sm text-slate-500">{{ $clinica->cidade ?: 'Online' }} {{ $clinica->uf ? '- '.$clinica->uf : '' }}</p>
                        <div class="mt-3 flex items-center justify-between text-xs font-bold">
                            <span class="text-amber-500">Nota {{ $clinica->nota ?? '-' }}</span>
                            <span class="{{ $clinica->aberta_agora ? 'text-accent' : 'text-slate-400' }}">{{ $clinica->aberta_agora ? 'Aberta' : 'Horario informado' }}</span>
                        </div>
                    </a>
                @empty
                    <p class="col-span-full rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm font-semibold text-slate-500">Nenhuma clinica cadastrada.</p>
                @endforelse
            </div>
        </div>

        <div class="vt-card p-5">
            <h2 class="font-display text-lg font-bold text-slate-950">Atividades recentes</h2>
            <div class="mt-4 space-y-4">
                @forelse($atividades as $atividade)
                    <div class="flex gap-3">
                        <div class="flex h-10 w-10 shrink-0 items-center justify-center rounded-xl {{ $atividade['cor'] }}">
                            <i data-lucide="{{ $atividade['icone'] }}" class="h-5 w-5 {{ $atividade['cor_icone'] }}"></i>
                        </div>
                        <div>
                            <p class="font-bold text-slate-900">{{ $atividade['titulo'] }}</p>
                            <p class="text-sm text-slate-500">{{ $atividade['descricao'] }}</p>
                            <p class="mt-1 text-xs font-semibold text-slate-400">{{ optional($atividade['data'])->diffForHumans() }}</p>
                        </div>
                    </div>
                @empty
                    <p class="rounded-2xl border border-dashed border-slate-300 p-6 text-center text-sm font-semibold text-slate-500">Nenhuma atividade recente.</p>
                @endforelse
            </div>
        </div>
    </section>
</div>
@endsection
