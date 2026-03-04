<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'Dashboard')</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .sidebar {
            min-height: 100vh;
        }

        .card-hover:hover {
            transform: scale(1.02);
            transition: 0.2s;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">

        <!-- Sidebar -->
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar collapse">
            <div class="position-sticky pt-3 text-white">
                <h4 class="text-center">🐾 VetTech</h4>
                <hr class="text-secondary">

                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('home') }}">
                            Dashboard
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="{{ route('animais.index') }}">
                            Pets
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white" href="#">
                            Atendimentos
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-danger" href="#">
                            Sair
                        </a>
                    </li>
                </ul>
            </div>
        </nav>

        <!-- Conteúdo Principal -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

            <!-- Navbar Superior -->
            <div class="d-flex justify-content-between align-items-center pt-3 pb-2 mb-3 border-bottom">
                <h2>@yield('page-title')</h2>

                <div>
                    <span class="me-3">Bem-vindo, {{ Auth::user()->name ?? 'Usuário' }}</span>
                </div>
            </div>

            <!-- Mensagens -->
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Conteúdo das páginas -->
            @yield('content')

        </main>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
