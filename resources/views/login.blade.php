@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<form action="{{ route('login') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">E-mail</label>
        <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Senha</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary w-100">Entrar</button>
</form>
<div class="mt-3 text-center">
    <a href="{{ route('register') }}">Não tem conta? Cadastre-se</a>
</div>

<form action="{{ route('logout') }}" method="POST">
    @csrf
    <button class="btn btn-danger">Sair</button>
</form>
@endsection
