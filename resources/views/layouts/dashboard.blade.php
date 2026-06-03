<ul class="nav flex-column px-2">

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('dashboard') }}">
            🏠 Dashboard
        </a>
    </li>

    <hr class="text-secondary">

    <!-- PETS -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('animais.index') }}">
            🐶 Meus Pets
        </a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('animais.create') }}">
            ➕ Novo Pet
        </a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('vacinas.index') }}">
            💉 Carteira de Vacinação
        </a>
    </li>

    <hr class="text-secondary">

    <!-- CONSULTAS -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('consultas.index') }}">
            📅 Consultas
        </a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('consultas.create') }}">
            ➕ Nova Consulta
        </a>
    </li>

    <hr class="text-secondary">

    <!-- ATENDIMENTOS -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('atendimentos.index') }}">
            📋 Atendimentos
        </a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('atendimentos.create') }}">
            ➕ Novo Atendimento
        </a>
    </li>

    <hr class="text-secondary">

    <!-- CLÍNICAS -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('clinicas.index') }}">
            🏥 Clínicas
        </a>
    </li>

    <!-- TELEMEDICINA -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('telemedicina.index') }}">
            🩺 Telemedicina
        </a>
    </li>

    <hr class="text-secondary">

    <!-- CHAT -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('chat') }}">
            💬 Chat
        </a>
    </li>

    <hr class="text-secondary">

    <!-- SITE -->
    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('contato') }}">
            📞 Contato
        </a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('pagamento') }}">
            💳 Pagamento
        </a>
    </li>

    <li class="nav-item mb-2">
        <a class="nav-link text-white" href="{{ route('sobre') }}">
            ℹ️ Sobre
        </a>
    </li>

    <!-- LOGOUT -->
    <li class="nav-item mt-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button class="nav-link text-danger btn btn-link w-100 text-start">
                🚪 Sair
            </button>
        </form>
    </li>

</ul>
