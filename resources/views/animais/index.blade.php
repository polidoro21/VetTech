@extends('layouts.dashboard')

@section('title', 'Lista de Pets')
@section('page-title', 'Lista de Pets')

@section('content')

<a href="{{ route('animais.create') }}" class="btn btn-primary mb-3">
    + Novo Pet
</a>

<div class="card shadow">
    <div class="card-body">

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Espécie</th>
                    <th>Idade</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($pets as $pet)
                <tr>
                    <td>{{ $pet->nome }}</td>
                    <td>{{ $pet->especie }}</td>
                    <td>{{ $pet->idade }}</td>
                    <td>
                        <td>
                            <a href="{{ route('animais.edit', $pet->id) }}" class="btn btn-warning btn-sm">
                                Editar
                            </a>

                            <form action="{{ route('animais.destroy', $pet->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')

                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Tem certeza que deseja excluir?')">
                                    Excluir
                                </button>
                            </form>
                        </td>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>

@endsection
