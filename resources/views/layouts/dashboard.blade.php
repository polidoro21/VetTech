<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'VetTech')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Sora:wght@500;600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: { DEFAULT: '#2563EB', dark: '#1d4ed8', light: '#eff6ff', soft: '#dbeafe' },
                        accent: { DEFAULT: '#10B981', dark: '#059669', light: '#ecfdf5', soft: '#d1fae5' },
                        warn: { DEFAULT: '#F59E0B', light: '#fffbeb', soft: '#fde68a' },
                    },
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #f8fafc; }
        .vt-card { background: #fff; border: 1px solid #e2e8f0; border-radius: 18px; box-shadow: 0 8px 24px rgba(15, 23, 42, .06); }
        .vt-input { width: 100%; border: 1px solid #cbd5e1; background: #fff; border-radius: 12px; padding: .72rem .9rem; font-size: .925rem; color: #0f172a; }
        .vt-input:focus { outline: none; border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37, 99, 235, .14); }
        .vt-label { display: block; color: #334155; font-size: .82rem; font-weight: 700; margin-bottom: .4rem; }
        .vt-btn { display: inline-flex; align-items: center; justify-content: center; gap: .45rem; border-radius: 12px; font-weight: 700; transition: .18s ease; }
        .vt-btn-primary { background: #2563EB; color: #fff; }
        .vt-btn-primary:hover { background: #1d4ed8; transform: translateY(-1px); }
        .vt-btn-accent { background: #10B981; color: #fff; }
        .vt-btn-accent:hover { background: #059669; transform: translateY(-1px); }
        .vt-btn-ghost { background: #f8fafc; color: #475569; border: 1px solid #e2e8f0; }
        .vt-btn-ghost:hover { background: #f1f5f9; }
        .vt-btn-danger { background: #fee2e2; color: #b91c1c; border: 1px solid #fecaca; }
        .nav-item { display: flex; align-items: center; gap: .75rem; padding: .65rem .8rem; border-radius: 12px; color: #64748b; font-weight: 600; font-size: .9rem; }
        .nav-item:hover { background: #f1f5f9; color: #0f172a; }
        .nav-item.active { background: #eff6ff; color: #2563EB; }
        .nav-icon { width: 1.1rem; height: 1.1rem; }
    </style>
    @stack('styles')
</head>

<body class="text-slate-800 antialiased">
    @php
        $user = auth()->user();
        $roleLabel = [
            'admin' => 'Administracao',
            'vet' => 'Area veterinaria',
            'clinic' => 'Area da clinica',
            'tutor' => 'Area do cliente',
        ][$user->tipo ?? 'tutor'] ?? 'Area VetTech';
        $navAtendimentos = $user?->tipo === 'tutor'
            ? \App\Models\Atendimento::where('user_id', auth()->id())->whereIn('status', ['aguardando', 'em_atendimento'])->count()
            : 0;
    @endphp

    <div id="sidebarOverlay" class="fixed inset-0 z-30 hidden bg-slate-950/45 lg:hidden"></div>

    <aside id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 -translate-x-full border-r border-slate-200 bg-white transition-transform lg:translate-x-0">
        <div class="flex h-full flex-col">
            <div class="flex items-center gap-3 border-b border-slate-100 px-5 py-5">
                <div class="flex h-10 w-10 items-center justify-center rounded-xl bg-gradient-to-br from-brand to-accent text-white">
                    <i data-lucide="heart-pulse" class="h-5 w-5"></i>
                </div>
                <div>
                    <p class="font-display text-lg font-bold text-slate-950">VetTech</p>
                    <p class="text-xs font-semibold text-slate-400">{{ $roleLabel }}</p>
                </div>
            </div>

            <nav class="flex-1 space-y-1 overflow-y-auto px-3 py-4">
                <p class="px-3 pb-2 text-[11px] font-extrabold uppercase tracking-wider text-slate-400">Principal</p>

                @if($user->tipo === 'admin')
                    <a href="{{ route('admin.clinicas.index') }}" class="nav-item {{ request()->routeIs('admin.clinicas.*') ? 'active' : '' }}">
                        <i data-lucide="shield-check" class="nav-icon"></i> Aprovacoes
                    </a>
                @elseif($user->tipo === 'vet')
                    <a href="{{ route('vet.atendimentos.index') }}" class="nav-item {{ request()->routeIs('vet.atendimentos.*') ? 'active' : '' }}">
                        <i data-lucide="stethoscope" class="nav-icon"></i> Sala de espera
                    </a>
                @elseif($user->tipo === 'clinic')
                    <a href="{{ route('clinicas.profile') }}" class="nav-item {{ request()->routeIs('clinicas.profile*') ? 'active' : '' }}">
                        <i data-lucide="building-2" class="nav-icon"></i> Minha clinica
                    </a>
                @else
                    <a href="{{ route('dashboard') }}" class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <i data-lucide="layout-dashboard" class="nav-icon"></i> Dashboard
                    </a>
                    <a href="{{ route('animais.index') }}" class="nav-item {{ request()->routeIs('animais.*') ? 'active' : '' }}">
                        <i data-lucide="paw-print" class="nav-icon"></i> Meus Pets
                    </a>
                    <a href="{{ route('atendimentos.index') }}" class="nav-item {{ request()->routeIs('atendimentos.*') ? 'active' : '' }}">
                        <i data-lucide="messages-square" class="nav-icon"></i> Atendimentos
                        @if($navAtendimentos > 0)
                            <span class="ml-auto rounded-full bg-brand px-2 py-0.5 text-[11px] text-white">{{ $navAtendimentos }}</span>
                        @endif
                    </a>
                    <a href="{{ route('clinicas.index') }}" class="nav-item {{ request()->routeIs('clinicas.index', 'clinicas.buscar', 'clinicas.show') ? 'active' : '' }}">
                        <i data-lucide="building-2" class="nav-icon"></i> Clinicas
                    </a>
                    <a href="{{ route('vacinas.index') }}" class="nav-item {{ request()->routeIs('vacinas.*') ? 'active' : '' }}">
                        <i data-lucide="syringe" class="nav-icon"></i> Carteirinha
                    </a>
                @endif
            </nav>

            <div class="border-t border-slate-100 p-4">
                <div class="mb-3 flex items-center gap-3 rounded-xl bg-slate-50 p-3">
                    <div class="flex h-9 w-9 items-center justify-center rounded-full bg-brand text-sm font-bold text-white">
                        {{ strtoupper(mb_substr($user->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="min-w-0">
                        <p class="truncate text-sm font-bold text-slate-800">{{ $user->name ?? 'Usuario' }}</p>
                        <p class="truncate text-xs text-slate-400">{{ $user->email ?? '' }}</p>
                    </div>
                </div>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="nav-item w-full text-rose-500 hover:bg-rose-50 hover:text-rose-600">
                        <i data-lucide="log-out" class="nav-icon"></i> Sair
                    </button>
                </form>
            </div>
        </div>
    </aside>

    <div class="min-h-screen lg:pl-64">
        <header class="sticky top-0 z-20 border-b border-slate-200 bg-white/95 backdrop-blur">
            <div class="flex items-center gap-4 px-4 py-4 sm:px-6 lg:px-8">
                <button id="openSidebar" type="button" class="vt-btn vt-btn-ghost h-10 w-10 p-0 lg:hidden" aria-label="Abrir menu">
                    <i data-lucide="menu" class="h-5 w-5"></i>
                </button>
                <div>
                    <h1 class="font-display text-xl font-bold text-slate-950">@yield('page-title', 'Dashboard')</h1>
                    <p class="text-sm text-slate-400">@yield('page-subtitle', 'Saude animal conectada')</p>
                </div>
                <div class="ml-auto hidden items-center gap-2 rounded-full bg-accent-light px-3 py-1.5 text-xs font-bold text-accent sm:flex">
                    <span class="h-2 w-2 rounded-full bg-accent"></span>
                    Online
                </div>
            </div>
        </header>

        <main class="px-4 py-6 sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-semibold text-emerald-700">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="mb-5 rounded-xl border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-700">
                    <p class="mb-1 font-bold">Confira os campos destacados:</p>
                    <ul class="list-inside list-disc">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>
    </div>

    <script>
        lucide.createIcons();
        const sidebar = document.getElementById('sidebar');
        const overlay = document.getElementById('sidebarOverlay');
        const openBtn = document.getElementById('openSidebar');
        function closeSidebar() {
            sidebar.classList.add('-translate-x-full');
            overlay.classList.add('hidden');
        }
        if (openBtn) {
            openBtn.addEventListener('click', () => {
                sidebar.classList.remove('-translate-x-full');
                overlay.classList.remove('hidden');
            });
        }
        overlay.addEventListener('click', closeSidebar);
    </script>
    @stack('scripts')
</body>

</html>
