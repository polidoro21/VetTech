@extends('layouts.dashboard')

@section('title', 'VetTech - Minha Clinica')
@section('page-title', 'Minha Clinica')
@section('page-subtitle', 'Complete os dados publicos e acompanhe a aprovacao')

@section('content')
@php
    $pending = $clinica?->pending_changes ?? [];
    $display = fn ($field, $fallback = null) => old($field, $pending[$field] ?? optional($clinica)->{$field} ?? $fallback);
@endphp

<div class="grid gap-6 xl:grid-cols-[1fr_.75fr]">
    <section class="vt-card p-6">
        <h2 class="font-display text-lg font-bold text-slate-950">Dados publicos</h2>
        <p class="mt-1 text-sm text-slate-500">Essas informacoes aparecem para tutores depois da aprovacao.</p>

        <form action="{{ route('clinicas.profile.update') }}" method="POST" class="mt-6 space-y-5">
            @csrf
            <div class="grid gap-5 md:grid-cols-2">
                <div class="md:col-span-2">
                    <label class="vt-label" for="nome">Nome da clinica</label>
                    <input id="nome" name="nome" class="vt-input" value="{{ $display('nome') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="tipo">Tipo</label>
                    <input id="tipo" name="tipo" class="vt-input" value="{{ $display('tipo', 'Clinica veterinaria') }}" required>
                </div>
                <div>
                    <label class="vt-label" for="telefone">Telefone publico</label>
                    <input id="telefone" name="telefone" class="vt-input" value="{{ $display('telefone', auth()->user()->phone) }}">
                </div>
                <div>
                    <label class="vt-label" for="email">Email publico</label>
                    <input id="email" name="email" type="email" class="vt-input" value="{{ $display('email', auth()->user()->email) }}">
                </div>
                <div>
                    <label class="vt-label" for="horario_abertura">Horario</label>
                    <input id="horario_abertura" name="horario_abertura" class="vt-input" value="{{ $display('horario_abertura') }}" placeholder="08:00 as 18:00">
                </div>
                <div>
                    <label class="vt-label" for="cep">CEP</label>
                    <input id="cep" name="cep" class="vt-input" value="{{ $display('cep') }}">
                </div>
                <div>
                    <label class="vt-label" for="logradouro">Logradouro</label>
                    <input id="logradouro" name="logradouro" class="vt-input" value="{{ $display('logradouro') }}">
                </div>
                <div>
                    <label class="vt-label" for="numero">Numero</label>
                    <input id="numero" name="numero" class="vt-input" value="{{ $display('numero') }}">
                </div>
                <div>
                    <label class="vt-label" for="bairro">Bairro</label>
                    <input id="bairro" name="bairro" class="vt-input" value="{{ $display('bairro') }}">
                </div>
                <div>
                    <label class="vt-label" for="cidade">Cidade</label>
                    <input id="cidade" name="cidade" class="vt-input" value="{{ $display('cidade') }}">
                </div>
                <div>
                    <label class="vt-label" for="uf">UF</label>
                    <input id="uf" name="uf" maxlength="2" class="vt-input uppercase" value="{{ $display('uf') }}">
                </div>
                <div class="md:col-span-2">
                    <label class="vt-label" for="descricao">Descricao</label>
                    <textarea id="descricao" name="descricao" class="vt-input min-h-32">{{ $display('descricao') }}</textarea>
                </div>
            </div>

            <div class="grid gap-3 sm:grid-cols-2">
                <label class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4 text-sm font-semibold text-slate-700">
                    <input type="hidden" name="aberta_agora" value="0">
                    <input type="checkbox" name="aberta_agora" value="1" @checked((bool) $display('aberta_agora', false))>
                    Aberta agora
                </label>
                <label class="flex items-center gap-3 rounded-2xl bg-slate-50 p-4 text-sm font-semibold text-slate-700">
                    <input type="hidden" name="telemedicina" value="0">
                    <input type="checkbox" name="telemedicina" value="1" @checked((bool) $display('telemedicina', false))>
                    Aceita atendimento remoto
                </label>
            </div>

            <button type="submit" class="vt-btn vt-btn-primary px-5 py-3">Enviar para aprovacao</button>
        </form>
    </section>

    <aside class="space-y-6">
        <div class="vt-card p-6">
            <h3 class="font-display text-lg font-bold text-slate-950">Status</h3>
            @if(!$clinica)
                <p class="mt-3 rounded-2xl bg-warn-light p-4 text-sm font-semibold text-warn">Complete o formulario para enviar sua clinica para aprovacao.</p>
            @else
                <div class="mt-4 rounded-2xl bg-slate-50 p-4">
                    <p class="text-sm font-bold text-slate-400">Situacao atual</p>
                    <p class="mt-1 text-lg font-extrabold text-slate-950">{{ $clinica->status === 'approved' ? 'Aprovada' : ($clinica->status === 'rejected' ? 'Rejeitada' : 'Pendente') }}</p>
                    @if($clinica->approved_at)
                        <p class="mt-1 text-xs font-semibold text-slate-400">Aprovada em {{ $clinica->approved_at->format('d/m/Y H:i') }}</p>
                    @endif
                </div>
                @if($clinica->pending_changes)
                    <p class="mt-3 rounded-2xl bg-brand-light p-4 text-sm font-semibold text-brand">Ha alteracoes aguardando aprovacao. O perfil publico ainda mostra a versao anterior.</p>
                @endif
                @if($clinica->rejection_reason)
                    <p class="mt-3 rounded-2xl bg-red-50 p-4 text-sm font-semibold text-red-600">{{ $clinica->rejection_reason }}</p>
                @endif
            @endif
        </div>

        <div class="vt-card p-6">
            <h3 class="font-display text-lg font-bold text-slate-950">Regra de publicacao</h3>
            <p class="mt-2 text-sm text-slate-500">Novas clinicas e alteracoes ficam ocultas ate o administrador aprovar. Isso protege a busca publica e evita dados sem revisao.</p>
        </div>
    </aside>
</div>
@endsection
