@extends('layouts.app')

@section('title', 'Login')

@section('content')

<style>
    /* CENTRALIZA E LIMITA O FORM */
    .login-box {
        max-width: 400px;
        margin: 60px auto;
        background: white;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 10px #ddd;
    }

    /* INPUTS BONITOS */
    .login-box input {
        width: 100%;
        padding: 10px;
        border-radius: 6px;
        border: 1px solid #ccc;
    }

    /* BOTÃO PADRÃO DO SITE */
    .login-box .btn {
        width: 100%;
        background: #436ef8;
        color: black;
        border: none;
        padding: 10px;
        border-radius: 8px;
        font-weight: bold;
        cursor: pointer;
    }

    .login-box .btn:hover {
        transform: scale(1.03);
    }
</style>

<div class="login-box">
    <form action="{{ route('login') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>E-mail</label>
            <input type="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" required>
        </div>

        <button type="submit" class="btn">Entrar</button>
    </form>

    <div class="mt-3 text-center">
        <a href="{{ route('cadastro') }}">Não tem conta? Cadastre-se</a>
    </div>
</div>

@endsection
