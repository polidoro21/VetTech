@extends('layout')

@section('content')

<h2 style="margin-bottom: 30px;">Cadastro de Atendimento</h2>

@if(session('success'))
    <div style="background: #d4edda; color: #155724; padding: 12px; border-radius: 6px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('atendimentos.store') }}" method="POST" style="text-align: left; max-width: 500px; margin: 0 auto;">
    @csrf

    <label>Animal</label>
    <select name="animal_id" required>
        @foreach($animais as $animal)
            <option value="{{ $animal->id }}">{{ $animal->nome }}</option>
        @endforeach
    </select>

    <label>Data</label>
    <input type="date" name="data" required>

    <label>Descrição</label>
    <textarea name="descricao" required></textarea>

    <label>Valor</label>
    <input type="number" step="0.01" name="valor" required>

    <label>Observações</label>
    <textarea name="observacoes"></textarea>

    <button type="submit" class="btn-primary">Cadastrar Atendimento</button>
</form>

<hr style="margin: 50px 0;">

<h2 style="margin-bottom: 20px;">Atendimentos Cadastrados</h2>

@if($atendimentos->isEmpty())
    <p>Nenhum atendimento cadastrado ainda.</p>
@else
    <table style="width: 100%; border-collapse: collapse; text-align: left;">
        <thead>
            <tr>
                <th style="padding: 8px;">Animal</th>
                <th style="padding: 8px;">Data</th>
                <th style="padding: 8px;">Descrição</th>
                <th style="padding: 8px;">Valor</th>
                <th style="padding: 8px;">Observações</th>
                <th style="padding: 8px;">Status</th>
                <th style="padding: 8px;">Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($atendimentos as $at)
            <tr>
                <td style="padding: 8px;">{{ $at->animal->nome }}</td>
                <td style="padding: 8px;">{{ $at->data }}</td>
                <td style="padding: 8px;">{{ $at->descricao }}</td>
                <td style="padding: 8px;">R$ {{ number_format($at->valor, 2, ',', '.') }}</td>
                <td style="padding: 8px;">{{ $at->observacoes }}</td>

                {{-- STATUS --}}
                <td style="padding: 8px;">
                    @if($at->status == 'nao_atendido')
                        <span style="background: orange; color: white; padding: 5px 10px; border-radius: 5px;">
                            Não atendido
                        </span>
                    @else
                        <span style="background: green; color: white; padding: 5px 10px; border-radius: 5px;">
                            Atendido
                        </span>
                    @endif
                </td>

                {{-- BOTÕES --}}
                <td style="padding: 8px;">
                    <form action="{{ route('atendimentos.status', $at->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        @if($at->status == 'nao_atendido')
                            <input type="hidden" name="status" value="atendido">
                            <button style="background: green; color: white; border: none; padding: 5px 10px; border-radius: 5px;">
                                ✔ Já foi atendido
                            </button>
                        @else
                            <input type="hidden" name="status" value="nao_atendido">
                            <button style="background: orange; color: white; border: none; padding: 5px 10px; border-radius: 5px;">
                                ↩ Não atendido
                            </button>
                        @endif
                    </form>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
@endif

@endsection
