@extends('layouts.dashboard')

@section('content')

<h3>Chat com o Admin</h3>

<div style="height:400px; overflow-y:auto; border:1px solid #ccc; padding:15px; background:#f5f5f5;">

    @foreach($messages as $msg)

        @if($msg->usuario == (session('usuario')['nome'] ?? ''))
            <!-- MINHA MENSAGEM -->
            <div style="text-align:right; margin-bottom:10px;">
                <span style="background:#0d6efd; color:white; padding:8px 12px; border-radius:15px; display:inline-block;">
                    {{ $msg->mensagem }}
                </span>
            </div>
        @else
            <!-- ADMIN -->
            <div style="text-align:left; margin-bottom:10px;">
                <span style="background:#e4e6eb; padding:8px 12px; border-radius:15px; display:inline-block;">
                    <strong>{{ $msg->usuario }}:</strong> {{ $msg->mensagem }}
                </span>
            </div>
        @endif

    @endforeach

</div>

<form action="{{ route('chat.send') }}" method="POST" class="mt-3">
    @csrf
    <div class="d-flex">
        <input type="text" name="mensagem" class="form-control" placeholder="Digite sua mensagem..." required>
        <button class="btn btn-primary ms-2">Enviar</button>
    </div>
</form>

@endsection
