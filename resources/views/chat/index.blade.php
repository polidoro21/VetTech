@extends('layouts.dashboard')

@section('title', 'VetTech - Chat')
@section('page-title', 'Chat')
@section('page-subtitle', 'Conversa com a equipe VetTech')

@section('content')
<div class="vt-card mx-auto flex max-w-4xl flex-col overflow-hidden">
    <div class="border-b border-slate-100 p-5">
        <h2 class="font-display text-lg font-bold text-slate-950">Mensagens</h2>
        <p class="text-sm text-slate-400">Historico da sua conta</p>
    </div>

    <div class="max-h-[520px] min-h-[360px] space-y-4 overflow-y-auto bg-slate-50 p-5">
        @forelse($messages as $message)
            <div class="flex justify-end">
                <div class="max-w-[80%] rounded-2xl rounded-br-md bg-brand px-4 py-3 text-white shadow-sm">
                    <p class="text-sm">{{ $message->mensagem }}</p>
                    <p class="mt-1 text-right text-[11px] font-semibold text-white/70">{{ $message->created_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        @empty
            <div class="flex h-80 flex-col items-center justify-center text-center text-slate-400">
                <i data-lucide="message-circle" class="mb-3 h-12 w-12"></i>
                <p class="font-semibold">Nenhuma mensagem enviada ainda.</p>
            </div>
        @endforelse
    </div>

    <form action="{{ route('chat.send') }}" method="POST" class="flex flex-col gap-3 border-t border-slate-100 p-4 sm:flex-row">
        @csrf
        <input type="text" name="mensagem" class="vt-input flex-1" placeholder="Digite sua mensagem..." required>
        <button class="vt-btn vt-btn-primary px-5 py-3" type="submit">Enviar</button>
    </form>
</div>
@endsection
