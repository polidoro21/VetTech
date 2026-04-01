<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>VetTech Care</title>

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body>

<header>
    <h1>VetTech Care</h1>
    <p>Plataforma de apoio ao atendimento veterinário</p>
</header>

<nav>
    <a href="{{ route('home') }}">Início</a>
    <a href="{{ route('atendimentos.index') }}">Atendimentos</a>
    <a href="{{ route('contato') }}">Contato</a>

    @auth
        <form action="{{ route('logout') }}" method="POST" style="display:inline;">
            @csrf
            <button style="background:red;color:white;border:none;padding:5px 10px;border-radius:5px;">
                Sair
            </button>
        </form>
    @endauth

    @guest
        <a href="{{ route('login') }}">Login</a>
    @endguest
</nav>

<main>
    @yield('content')
</main>

<footer>
    © 2025 VetTech Care | Desenvolvido por Lorrayne ,Roger e Deyse
</footer>

</body>
</html>
