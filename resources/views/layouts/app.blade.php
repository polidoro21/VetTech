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
    <a href="/">Início</a>
    <a href="/cadastro">Cadastro</a>
    <a href="/atendimentos">Atendimentos</a>
    <a href="/contato">Contato</a>
</nav>

<main>
    @yield('content')
</main>

<footer>
    © 2025 VetTech Care | Desenvolvido por Lorrayne França
</footer>

</body>
</html>
