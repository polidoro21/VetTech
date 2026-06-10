@extends('layouts.dashboard')

@section('title', 'VetTech - Cadastrar Pet')
@section('page-title', 'Cadastrar Pet')
@section('page-subtitle', 'Informe os dados principais do animal')

@section('content')
<div class="vt-card max-w-3xl p-6">
    <form action="{{ route('animais.store') }}" method="POST" class="space-y-5">
        @csrf
        @include('animais.partials.form', ['animal' => null])

        <div class="flex flex-wrap gap-3 pt-2">
            <button type="submit" class="vt-btn vt-btn-primary px-5 py-3">Salvar pet</button>
            <a href="{{ route('animais.index') }}" class="vt-btn vt-btn-ghost px-5 py-3">Cancelar</a>
        </div>
    </form>
</div>
@endsection
