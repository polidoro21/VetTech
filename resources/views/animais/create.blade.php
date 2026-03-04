@extends('layouts.dashboard')

@section('title', 'Cadastrar Animal')
@section('page-title', 'Cadastrar Novo Animal')

@section('content')

<div class="card shadow">
    <div class="card-body">

        <form action="{{ route('animais.store') }}" method="POST">
            @csrf

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Nome</label>
                    <input type="text" name="nome" class="form-control" required>
                </div>

                <div class="col-md-6">
                    <label class="form-label">Espécie</label>
                    <input type="text" name="especie" class="form-control" required>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Raça</label>
                    <input type="text" name="raca" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Cor</label>
                    <input type="text" name="cor" class="form-control">
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-md-6">
                    <label class="form-label">Data de Nascimento</label>
                    <input type="date" name="data_nascimento" class="form-control">
                </div>

                <div class="col-md-6">
                    <label class="form-label">Porte</label>
                    <select name="porte" class="form-select" required>
                        <option value="">Selecione</option>
                        <option value="pequeno">Pequeno</option>
                        <option value="medio">Médio</option>
                        <option value="grande">Grande</option>
                    </select>
                </div>
            </div>

            <!-- id_usuario automático -->
            <input type="hidden" name="id_usuario" value="{{ Auth::id() }}">

            <div class="mt-4">
                <button type="submit" class="btn btn-success">
                    Salvar
                </button>
                <a href="{{ route('animais.index') }}" class="btn btn-secondary">
                    Cancelar
                </a>
            </div>

        </form>

    </div>
</div>

@endsection
