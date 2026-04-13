<body>

    <header>...</header>

    <nav>...</nav>

    <main>
        @yield('content')
    </main>

    <footer>...</footer>

    <!-- 🐾 Botão de Chat -->
    <a href="{{ route('chat') }}" class="paw-chat">
        🐾
    </a>

    <style>
        .paw-chat {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #0d6efd;
            color: white;
            font-size: 28px;
            padding: 15px;
            border-radius: 50%;
            text-decoration: none;
            box-shadow: 0 4px 10px rgba(0,0,0,0.3);
            z-index: 999;
            transition: 0.3s;
        }

        .paw-chat:hover {
            transform: scale(1.2);
            background-color: #0b5ed7;
        }
    </style>

</body>
