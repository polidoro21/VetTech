@extends('layouts.dashboard')

@section('title', 'VetTech - Editar Pet')
@section('page-title', 'Editar Pet')
@section('page-subtitle', 'Atualize os dados de '.$animal->nome)

@section('content')
<div class="vt-card max-w-3xl p-6">
    <form action="{{ route('animais.update', $animal->id) }}" method="POST" class="space-y-5">
        @csrf
        @method('PUT')
        @include('animais.partials.form', ['animal' => $animal])

        <div class="flex flex-wrap gap-3 pt-2">
            <button type="submit" class="vt-btn vt-btn-primary px-5 py-3">Atualizar pet</button>
            <a href="{{ route('animais.index') }}" class="vt-btn vt-btn-ghost px-5 py-3">Voltar</a>
        </div>
    </form>
</div>
@endsection
