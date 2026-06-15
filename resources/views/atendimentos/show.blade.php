@extends('layouts.dashboard')

@section('title', 'VetTech - Atendimento')
@section('page-title', 'Sala de Atendimento')
@section('page-subtitle', ($atendimento->animal->nome ?? 'Pet').' · '.str_replace('_', ' ', $atendimento->status))

@section('content')
@php
    $isVet = auth()->user()->tipo === 'vet';
    $isTutor = auth()->id() === $atendimento->user_id || optional($atendimento->animal)->id_usuario === auth()->id();
    $receiptUrl = $atendimento->receita_path ? \Illuminate\Support\Facades\Storage::disk('public')->url($atendimento->receita_path) : null;
@endphp

<div class="grid gap-6 xl:grid-cols-[1fr_.78fr]">
    <section class="space-y-6">
        <div class="vt-card p-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <h2 class="font-display text-2xl font-bold text-slate-950">{{ $atendimento->animal->nome ?? 'Pet removido' }}</h2>
                    <p class="text-sm text-slate-500">{{ ucfirst($atendimento->modo) }} · criado em {{ $atendimento->created_at->format('d/m/Y H:i') }}</p>
                </div>
                <span class="w-fit rounded-full bg-brand-light px-3 py-1 text-sm font-bold text-brand">{{ str_replace('_', ' ', $atendimento->status) }}</span>
            </div>

            <div class="mt-5 rounded-2xl bg-slate-50 p-4">
                <p class="text-sm font-bold text-slate-400">Solicitacao</p>
                <p class="mt-1 text-slate-700">{{ $atendimento->descricao }}</p>
                @if($atendimento->observacoes)
                    <p class="mt-3 text-sm text-slate-500">{{ $atendimento->observacoes }}</p>
                @endif
            </div>
        </div>

        @if($atendimento->status === 'aguardando' && $isTutor)
            <div class="vt-card p-8 text-center">
                <i data-lucide="loader-circle" class="mx-auto mb-4 h-12 w-12 animate-spin text-brand"></i>
                <h2 class="font-display text-xl font-bold text-slate-950">Voce esta na fila</h2>
                <p class="mx-auto mt-2 max-w-md text-sm text-slate-500">Assim que um veterinario disponivel aceitar, esta pagina vira a sala do atendimento.</p>
                <form method="POST" action="{{ route('atendimentos.cancel', $atendimento) }}" class="mt-5">
                    @csrf
                    <button type="submit" class="vt-btn vt-btn-danger px-5 py-3">Cancelar atendimento</button>
                </form>
            </div>
        @endif

        @if(in_array($atendimento->status, ['em_atendimento', 'finalizado'], true))
            <div id="chat" class="vt-card overflow-hidden">
                <div class="border-b border-slate-100 p-5">
                    <h2 class="font-display text-lg font-bold text-slate-950">Chat do atendimento</h2>
                    <p class="text-sm text-slate-400">Historico compartilhado entre tutor e veterinario.</p>
                </div>
                <div class="max-h-[480px] min-h-[320px] space-y-4 overflow-y-auto bg-slate-50 p-5">
                    @forelse($atendimento->messages as $message)
                        @php($own = $message->user_id === auth()->id())
                        <div class="flex {{ $own ? 'justify-end' : 'justify-start' }}">
                            <div class="max-w-[82%] rounded-2xl px-4 py-3 shadow-sm {{ $own ? 'rounded-br-md bg-brand text-white' : 'rounded-bl-md bg-white text-slate-800 border border-slate-200' }}">
                                <p class="text-xs font-bold {{ $own ? 'text-white/70' : 'text-slate-400' }}">{{ $message->usuario }}</p>
                                <p class="mt-1 text-sm">{{ $message->mensagem }}</p>
                                <p class="mt-1 text-right text-[11px] font-semibold {{ $own ? 'text-white/70' : 'text-slate-400' }}">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="flex h-72 flex-col items-center justify-center text-center text-slate-400">
                            <i data-lucide="message-circle" class="mb-3 h-12 w-12"></i>
                            <p class="font-semibold">Nenhuma mensagem ainda.</p>
                        </div>
                    @endforelse
                </div>

                @if($atendimento->status === 'em_atendimento')
                    <form action="{{ route('atendimentos.messages', $atendimento) }}" method="POST" class="flex flex-col gap-3 border-t border-slate-100 p-4 sm:flex-row">
                        @csrf
                        <input type="text" name="mensagem" class="vt-input flex-1" placeholder="Digite sua mensagem..." required>
                        <button class="vt-btn vt-btn-primary px-5 py-3" type="submit">Enviar</button>
                    </form>
                @endif
            </div>
        @endif

        @if($atendimento->status === 'finalizado')
            <div class="vt-card p-6">
                <h2 class="font-display text-lg font-bold text-slate-950">Resultado do atendimento</h2>
                <div class="mt-4 grid gap-4">
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm font-bold text-slate-400">Descricao do observado</p>
                        <p class="mt-1 text-slate-700">{{ $atendimento->descricao_observado ?: 'Nao informado' }}</p>
                    </div>
                    <div class="rounded-2xl bg-slate-50 p-4">
                        <p class="text-sm font-bold text-slate-400">Anotacoes</p>
                        <p class="mt-1 text-slate-700">{{ $atendimento->anotacoes ?: 'Sem anotacoes adicionais' }}</p>
                    </div>
                    @if($receiptUrl)
                        <a href="{{ $receiptUrl }}" target="_blank" class="vt-btn vt-btn-accent w-fit px-4 py-3">
                            <i data-lucide="file-down" class="h-4 w-4"></i> Abrir receita
                        </a>
                    @endif
                </div>
            </div>
        @endif
    </section>

    <aside class="space-y-6">
        <div class="vt-card p-6">
            <h3 class="font-display text-lg font-bold text-slate-950">Dados da sala</h3>
            <dl class="mt-4 space-y-3 text-sm">
                <div class="rounded-xl bg-slate-50 p-3">
                    <dt class="font-bold text-slate-400">Veterinario</dt>
                    <dd class="font-semibold text-slate-900">{{ $atendimento->veterinario->name ?? 'Aguardando aceite' }}</dd>
                </div>
                <div class="rounded-xl bg-slate-50 p-3">
                    <dt class="font-bold text-slate-400">Modo</dt>
                    <dd class="font-semibold text-slate-900">{{ ucfirst($atendimento->modo) }}</dd>
                </div>
                @if($atendimento->video_url)
                    <div class="rounded-xl bg-slate-50 p-3">
                        <dt class="font-bold text-slate-400">Link de video</dt>
                        <dd><a class="font-semibold text-brand hover:underline" href="{{ $atendimento->video_url }}" target="_blank">Abrir chamada</a></dd>
                    </div>
                @endif
            </dl>
        </div>

        @if($isVet && $atendimento->status === 'em_atendimento')
            <div class="vt-card p-6">
                <h3 class="font-display text-lg font-bold text-slate-950">Finalizar atendimento</h3>
                <form action="{{ route('atendimentos.finish', $atendimento) }}" method="POST" enctype="multipart/form-data" class="mt-5 space-y-4">
                    @csrf
                    <div>
                        <label class="vt-label" for="video_url">Link de video</label>
                        <input id="video_url" name="video_url" type="url" class="vt-input" value="{{ old('video_url', $atendimento->video_url) }}" placeholder="https://meet.google.com/...">
                    </div>
                    <div>
                        <label class="vt-label" for="descricao_observado">Descricao do observado</label>
                        <textarea id="descricao_observado" name="descricao_observado" class="vt-input min-h-28" required>{{ old('descricao_observado') }}</textarea>
                    </div>
                    <div>
                        <label class="vt-label" for="anotacoes">Anotacoes</label>
                        <textarea id="anotacoes" name="anotacoes" class="vt-input min-h-24">{{ old('anotacoes') }}</textarea>
                    </div>
                    <div>
                        <label class="vt-label" for="receita">Receita (PDF, JPG ou PNG)</label>
                        <input id="receita" name="receita" type="file" class="vt-input" accept=".pdf,.jpg,.jpeg,.png">
                    </div>
                    <button type="submit" class="vt-btn vt-btn-primary w-full px-4 py-3">Finalizar e liberar ao tutor</button>
                </form>
            </div>
        @endif

        <a href="{{ auth()->user()->tipo === 'vet' ? route('vet.atendimentos.index') : route('atendimentos.index') }}" class="vt-btn vt-btn-ghost w-full px-4 py-3">Voltar</a>
    </aside>
</div>

@if(in_array($atendimento->status, ['aguardando', 'em_atendimento'], true))
    @push('scripts')
        <script>
            setTimeout(() => window.location.reload(), 12000);
        </script>
    @endpush
@endif
@endsection
