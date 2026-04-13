<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Seu CSS -->
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            min-height: 100vh;
            background-color: #f4f6f9;
        }

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #1a1a1a, #343a40);
        }

        .sidebar h4 {
            font-weight: bold;
        }

        .nav-link {
            transition: 0.2s;
        }

        .nav-link:hover {
            background-color: #495057;
            border-radius: 5px;
        }

        main {
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px;
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block sidebar collapse text-white">
            <div class="position-sticky pt-3">
                <h4 class="text-center">🐾 VetTech</h4>
                <hr class="text-secondary">

                <ul class="nav flex-column px-2">

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('home') }}">
                            🏠 Dashboard
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('animais.index') }}">
                            🐶 Pets
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('atendimentos.index') }}">
                            📋 Atendimentos
                        </a>
                    </li>

                    <li class="nav-item mb-2">
                        <a class="nav-link text-white" href="{{ route('chat') }}">
                            💬 Chat
                        </a>
                    </li>

                    <!-- Logout CORRETO -->
                    <li class="nav-item mt-3">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="nav-link text-danger btn btn-link w-100 text-start">
                                🚪 Sair
                            </button>
                        </form>
                    </li>

                </ul>
            </div>
        </nav>

        <!-- Conteúdo -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Navbar -->
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>@yield('page-title')</h2>

                <div>
                    <span class="me-3">
                        👤 Bem-vindo, {{ session('usuario')['nome'] ?? 'Usuário' }}
                    </span>
                </div>
            </div>

            <!-- Mensagem sucesso -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')

        </main>

    </div>
</div>

<!-- JS Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
