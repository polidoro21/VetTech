<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetTech — Dashboard</title>

    <!-- ─── Tailwind CSS CDN ─── -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ─── Lucide Icons CDN ─── -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- ─── Google Fonts: DM Sans + Sora ─── -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700&family=Sora:wght@400;600;700;800&display=swap"
        rel="stylesheet" />

    <script>
        /* ─── Tailwind config — consistent with login & cadastro ─── */
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#2563EB',
                            dark: '#1d4ed8',
                            light: '#eff6ff',
                            soft: '#dbeafe'
                        },
                        accent: {
                            DEFAULT: '#10B981',
                            dark: '#059669',
                            light: '#ecfdf5',
                            soft: '#d1fae5'
                        },
                        warn: {
                            DEFAULT: '#F59E0B',
                            light: '#fffbeb',
                            soft: '#fde68a'
                        },
                        rose: {
                            soft: '#ffe4e6'
                        },
                    },
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Sora', 'sans-serif'],
                    },
                    keyframes: {
                        fadeUp: {
                            from: {
                                opacity: '0',
                                transform: 'translateY(18px)'
                            },
                            to: {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                        fadeIn: {
                            from: {
                                opacity: '0'
                            },
                            to: {
                                opacity: '1'
                            }
                        },
                        slideIn: {
                            from: {
                                opacity: '0',
                                transform: 'translateX(-18px)'
                            },
                            to: {
                                opacity: '1',
                                transform: 'translateX(0)'
                            }
                        },
                        pulse2: {
                            '0%,100%': {
                                opacity: '1'
                            },
                            '50%': {
                                opacity: '.5'
                            }
                        },
                        countUp: {
                            from: {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            to: {
                                opacity: '1',
                                transform: 'translateY(0)'
                            }
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp .55s cubic-bezier(.22,1,.36,1) both',
                        'fade-in': 'fadeIn .45s ease both',
                        'slide-in': 'slideIn .5s cubic-bezier(.22,1,.36,1) both',
                        'pulse2': 'pulse2 2s ease-in-out infinite',
                    },
                },
            },
        };
    </script>

    <style>
        /* ─── Base ─── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #f8fafc;
        }

        /* ─── Scrollbar ─── */
        ::-webkit-scrollbar {
            width: 5px;
            height: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 99px;
        }

        /* ═══════════════════════════════════════
       SIDEBAR
    ═══════════════════════════════════════ */
        #sidebar {
            width: 256px;
            transition: transform .3s cubic-bezier(.22, 1, .36, 1), width .3s ease;
            z-index: 40;
        }

        #sidebar.collapsed {
            width: 72px;
        }

        #sidebar.mobile-hidden {
            transform: translateX(-100%);
        }

        /* Sidebar overlay (mobile) */
        #sidebarOverlay {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .45);
            backdrop-filter: blur(2px);
            z-index: 39;
        }

        #sidebarOverlay.active {
            display: block;
        }

        /* Nav item */
        .nav-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 10px 14px;
            border-radius: 14px;
            cursor: pointer;
            transition: background .18s, color .18s;
            color: #64748b;
            font-size: .875rem;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-decoration: none;
        }

        .nav-item:hover {
            background: #f1f5f9;
            color: #1e293b;
        }

        .nav-item.active {
            background: #eff6ff;
            color: #2563EB;
            font-weight: 600;
        }

        .nav-item.active .nav-icon {
            color: #2563EB;
        }

        .nav-icon {
            width: 20px;
            height: 20px;
            flex-shrink: 0;
            transition: color .18s;
        }

        .nav-label {
            transition: opacity .2s, width .2s;
        }

        #sidebar.collapsed .nav-label {
            opacity: 0;
            width: 0;
            pointer-events: none;
        }

        #sidebar.collapsed .nav-item {
            justify-content: center;
            padding: 10px;
        }

        /* ═══════════════════════════════════════
       MAIN CONTENT
    ═══════════════════════════════════════ */
        #mainContent {
            margin-left: 256px;
            transition: margin-left .3s ease;
            min-height: 100vh;
        }

        #mainContent.sidebar-collapsed {
            margin-left: 72px;
        }

        @media (max-width: 1023px) {
            #mainContent {
                margin-left: 0 !important;
            }

            #sidebar {
                position: fixed;
                top: 0;
                left: 0;
                height: 100%;
            }
        }

        /* ═══════════════════════════════════════
       STAT CARDS
    ═══════════════════════════════════════ */
        .stat-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 4px 16px rgba(0, 0, 0, .04);
            transition: transform .22s ease, box-shadow .22s ease;
            overflow: hidden;
        }

        .stat-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, .1);
        }

        /* ═══════════════════════════════════════
       PET CARDS
    ═══════════════════════════════════════ */
        .pet-card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 4px 16px rgba(0, 0, 0, .04);
            transition: transform .22s ease, box-shadow .22s ease;
            overflow: hidden;
        }

        .pet-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 36px rgba(37, 99, 235, .12);
        }

        /* ═══════════════════════════════════════
       GENERIC CARD
    ═══════════════════════════════════════ */
        .card {
            background: #fff;
            border-radius: 20px;
            border: 1px solid #f1f5f9;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .06), 0 4px 16px rgba(0, 0, 0, .04);
        }

        /* ═══════════════════════════════════════
       BUTTONS
    ═══════════════════════════════════════ */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB, #1d4ed8);
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            transition: transform .18s, box-shadow .18s, background .18s;
        }

        .btn-primary:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(37, 99, 235, .38);
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
        }

        .btn-accent {
            background: linear-gradient(135deg, #10B981, #059669);
            color: #fff;
            font-weight: 600;
            border-radius: 12px;
            transition: transform .18s, box-shadow .18s;
        }

        .btn-accent:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, .38);
        }

        .btn-ghost {
            background: #f8fafc;
            color: #475569;
            font-weight: 500;
            border-radius: 12px;
            border: 1px solid #e2e8f0;
            transition: background .18s, border-color .18s;
        }

        .btn-ghost:hover {
            background: #f1f5f9;
            border-color: #cbd5e1;
        }

        /* ═══════════════════════════════════════
       TELEMEDICINE BANNER
    ═══════════════════════════════════════ */
        .tele-banner {
            background: linear-gradient(135deg, #2563EB 0%, #10B981 100%);
            border-radius: 24px;
            position: relative;
            overflow: hidden;
        }

        .tele-banner::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: radial-gradient(circle at 80% 50%, rgba(255, 255, 255, .12) 0%, transparent 60%);
        }

        .tele-banner::after {
            content: '';
            position: absolute;
            top: -40px;
            right: -40px;
            width: 200px;
            height: 200px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .06);
        }

        /* ═══════════════════════════════════════
       ONLINE PULSE DOT
    ═══════════════════════════════════════ */
        .online-dot {
            width: 10px;
            height: 10px;
            background: #10B981;
            border-radius: 50%;
            box-shadow: 0 0 0 0 rgba(16, 185, 129, .5);
            animation: onlinePulse 2s ease-in-out infinite;
        }

        @keyframes onlinePulse {
            0% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, .5);
            }

            70% {
                box-shadow: 0 0 0 8px rgba(16, 185, 129, 0);
            }

            100% {
                box-shadow: 0 0 0 0 rgba(16, 185, 129, 0);
            }
        }

        /* ═══════════════════════════════════════
       SEARCH
    ═══════════════════════════════════════ */
        .search-input {
            background: #f8fafc;
            border: 1.5px solid #e2e8f0;
            border-radius: 14px;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-input:focus {
            outline: none;
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, .12);
        }

        /* ═══════════════════════════════════════
       BADGE / PILL
    ═══════════════════════════════════════ */
        .badge-online {
            background: #d1fae5;
            color: #059669;
        }

        .badge-presencial {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .badge-ok {
            background: #d1fae5;
            color: #059669;
        }

        .badge-atencao {
            background: #fde68a;
            color: #92400e;
        }

        /* ═══════════════════════════════════════
       TABLE
    ═══════════════════════════════════════ */
        .table-row {
            transition: background .15s;
        }

        .table-row:hover {
            background: #f8fafc;
        }

        /* ═══════════════════════════════════════
       STAGGER DELAYS
    ═══════════════════════════════════════ */
        .d1 {
            animation-delay: .08s;
        }

        .d2 {
            animation-delay: .16s;
        }

        .d3 {
            animation-delay: .24s;
        }

        .d4 {
            animation-delay: .32s;
        }

        .d5 {
            animation-delay: .40s;
        }

        .d6 {
            animation-delay: .48s;
        }

        .d7 {
            animation-delay: .56s;
        }

        .d8 {
            animation-delay: .64s;
        }

        /* ─── Notification dot ─── */
        .notif-dot {
            width: 8px;
            height: 8px;
            background: #ef4444;
            border-radius: 50%;
            position: absolute;
            top: 1px;
            right: 1px;
            border: 1.5px solid #fff;
        }

        /* ─── Avatar ring ─── */
        .avatar-ring {
            box-shadow: 0 0 0 2.5px #fff, 0 0 0 4px #2563EB;
        }

        /* ─── Scrollable areas ─── */
        .scroll-x {
            overflow-x: auto;
            scrollbar-width: thin;
        }
    </style>
</head>

<body class="min-h-screen bg-slate-50 antialiased text-slate-800">

    <!-- ═══════════════════════════════════════════════════════════
     SIDEBAR OVERLAY (mobile)
═══════════════════════════════════════════════════════════ -->
    <div id="sidebarOverlay" onclick="closeSidebar()"></div>

    <!-- ═══════════════════════════════════════════════════════════
     SIDEBAR
═══════════════════════════════════════════════════════════ -->
    <aside id="sidebar"
        class="fixed top-0 left-0 h-full bg-white border-r border-slate-100 flex flex-col mobile-hidden lg:translate-x-0 animate-slide-in"
        style="animation-delay:.05s">

        <!-- ── Logo ── -->
        <div class="flex items-center gap-3 px-5 py-5 border-b border-slate-100 flex-shrink-0">
            <div
                class="w-9 h-9 rounded-xl bg-gradient-to-br from-brand to-accent flex items-center justify-center shadow-sm flex-shrink-0">
                <i data-lucide="heart-pulse" class="w-5 h-5 text-white"></i>
            </div>
            <div class="nav-label flex flex-col leading-tight overflow-hidden">
                <span class="font-display font-bold text-slate-900 text-base tracking-tight">VetTech</span>
                <span class="text-[10px] text-slate-400 font-medium">Saúde animal conectada</span>
            </div>
            <!-- Collapse toggle (desktop) -->
            <button id="collapseBtn" onclick="toggleCollapse()"
                class="ml-auto p-1.5 rounded-lg hover:bg-slate-100 text-slate-400 hover:text-slate-600 transition-colors nav-label flex-shrink-0"
                title="Recolher menu">
                <i data-lucide="panel-left-close" class="w-4 h-4"></i>
            </button>
        </div>

        <!-- ── Navigation ── -->
        <nav class="flex-1 overflow-y-auto px-3 py-4 space-y-0.5">

            <!-- Main group -->
            <p class="nav-label text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-2">Principal</p>

            <a href="#" class="nav-item active" data-section="dashboard">
                <i data-lucide="layout-dashboard" class="nav-icon"></i>
                <span class="nav-label">Dashboard</span>
            </a>
            <a href="#" class="nav-item" data-section="pets">
                <i data-lucide="paw-print" class="nav-icon"></i>
                <span class="nav-label">Meus Pets</span>
            </a>
            <a href="#" class="nav-item" data-section="consultas">
                <i data-lucide="clipboard-list" class="nav-icon"></i>
                <span class="nav-label">Consultas</span>
                <span
                    class="nav-label ml-auto bg-brand text-white text-[10px] font-bold px-1.5 py-0.5 rounded-full">3</span>
            </a>
            <a href="#" class="nav-item" data-section="telemedicina">
                <i data-lucide="video" class="nav-icon"></i>
                <span class="nav-label">Telemedicina</span>
                <span class="nav-label ml-auto flex items-center gap-1">
                    <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse2"></span>
                    <span class="text-[10px] text-accent font-semibold">Online</span>
                </span>
            </a>
            <a href="#" class="nav-item" data-section="clinicas">
                <i data-lucide="building-2" class="nav-icon"></i>
                <span class="nav-label">Clínicas</span>
            </a>
            <a href="#" class="nav-item" data-section="agendamentos">
                <i data-lucide="calendar-check" class="nav-icon"></i>
                <span class="nav-label">Agendamentos</span>
            </a>
            <a href="#" class="nav-item" data-section="carteirinha">
                <i data-lucide="credit-card" class="nav-icon"></i>
                <span class="nav-label">Carteirinha</span>
            </a>

            <!-- Divider -->
            <div class="border-t border-slate-100 my-3"></div>
            <p class="nav-label text-[10px] font-bold text-slate-400 uppercase tracking-widest px-2 mb-2">Conta</p>

            <a href="#" class="nav-item" data-section="config">
                <i data-lucide="settings" class="nav-icon"></i>
                <span class="nav-label">Configurações</span>
            </a>
            <a href="vettech-login.html" class="nav-item" data-section="sair">
                <i data-lucide="log-out" class="nav-icon text-rose-400"></i>
                <span class="nav-label text-rose-400">Sair</span>
            </a>

        </nav>

        <!-- ── User card ── -->
        <div class="px-3 py-4 border-t border-slate-100 flex-shrink-0">
            <div
                class="flex items-center gap-3 p-3 rounded-2xl hover:bg-slate-50 transition-colors cursor-pointer group">
                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=facearea&facepad=2.5&w=80&q=80"
                    alt="Lorrayne" class="w-9 h-9 rounded-full object-cover avatar-ring flex-shrink-0" />
                <div class="nav-label overflow-hidden">
                    <p class="text-sm font-semibold text-slate-800 truncate leading-tight">Lorrayne Silva</p>
                    <p class="text-xs text-slate-400 truncate">Tutora de Pet</p>
                </div>
                <i data-lucide="chevrons-up-down"
                    class="nav-label w-4 h-4 text-slate-300 group-hover:text-slate-500 transition-colors ml-auto flex-shrink-0"></i>
            </div>
        </div>

    </aside>
    <!-- /sidebar -->


    <!-- ═══════════════════════════════════════════════════════════
     MAIN CONTENT AREA
═══════════════════════════════════════════════════════════ -->
    <div id="mainContent" class="flex flex-col min-h-screen">

        <!-- ───────────────────────────────────────────────────────
       HEADER
  ─────────────────────────────────────────────────────────── -->
        <header
            class="sticky top-0 z-30 bg-white/90 backdrop-blur-md border-b border-slate-100 px-5 lg:px-8 py-4 flex items-center gap-4 animate-fade-in">

            <!-- Mobile menu toggle -->
            <button onclick="openSidebar()"
                class="lg:hidden p-2 rounded-xl hover:bg-slate-100 text-slate-500 transition-colors flex-shrink-0">
                <i data-lucide="menu" class="w-5 h-5"></i>
            </button>

            <!-- Greeting -->
            <div class="flex-1 min-w-0">
                <h1 class="font-display text-base sm:text-lg font-bold text-slate-900 truncate">
                    Bem-vinda de volta, Lorrayne 🐾
                </h1>
                <p class="text-xs text-slate-400 mt-0.5 hidden sm:block">Quarta-feira, 7 de maio de 2025 · Birigui, SP
                </p>
            </div>

            <!-- Search (hidden on very small screens) -->
            <div class="hidden md:flex items-center relative flex-shrink-0 w-60">
                <i data-lucide="search" class="absolute left-3 w-4 h-4 text-slate-400 pointer-events-none"></i>
                <input type="text" placeholder="Buscar…"
                    class="search-input w-full pl-9 pr-4 py-2.5 text-sm text-slate-700 placeholder-slate-400 focus:outline-none" />
            </div>

            <!-- Actions -->
            <div class="flex items-center gap-2 flex-shrink-0">

                <!-- Notifications -->
                <button class="relative p-2.5 rounded-xl hover:bg-slate-100 text-slate-500 transition-colors">
                    <i data-lucide="bell" class="w-5 h-5"></i>
                    <span class="notif-dot"></span>
                </button>

                <!-- Messages -->
                <button
                    class="relative p-2.5 rounded-xl hover:bg-slate-100 text-slate-500 transition-colors hidden sm:flex">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    <span class="notif-dot"></span>
                </button>

                <!-- Avatar -->
                <button class="ml-1 flex-shrink-0">
                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?auto=format&fit=facearea&facepad=2.5&w=80&q=80"
                        alt="Lorrayne" class="w-9 h-9 rounded-full object-cover avatar-ring" />
                </button>

            </div>
        </header>
        <!-- /header -->


        <!-- ───────────────────────────────────────────────────────
       PAGE BODY
  ─────────────────────────────────────────────────────────── -->
        <main class="flex-1 px-5 lg:px-8 py-7 space-y-8">


            <!-- ══════════════════════════════════════════════════
         SECTION 1 — STAT CARDS
    ══════════════════════════════════════════════════ -->
            <section>
                <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Card: Pets cadastrados -->
                    <div class="stat-card p-5 animate-fade-up d1">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-11 h-11 rounded-2xl bg-brand-light flex items-center justify-center">
                                <i data-lucide="paw-print" class="w-5 h-5 text-brand"></i>
                            </div>
                            <span class="text-xs font-semibold text-accent bg-accent-light px-2 py-1 rounded-full">+1
                                mês</span>
                        </div>
                        <p class="font-display text-3xl font-bold text-slate-900">3</p>
                        <p class="text-sm text-slate-500 mt-1">Pets cadastrados</p>
                        <div class="mt-3 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full w-3/4 bg-gradient-to-r from-brand to-accent rounded-full"></div>
                        </div>
                    </div>

                    <!-- Card: Consultas realizadas -->
                    <div class="stat-card p-5 animate-fade-up d2">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-11 h-11 rounded-2xl bg-accent-light flex items-center justify-center">
                                <i data-lucide="clipboard-list" class="w-5 h-5 text-accent"></i>
                            </div>
                            <span class="text-xs font-semibold text-brand bg-brand-light px-2 py-1 rounded-full">Este
                                ano</span>
                        </div>
                        <p class="font-display text-3xl font-bold text-slate-900">12</p>
                        <p class="text-sm text-slate-500 mt-1">Consultas realizadas</p>
                        <div class="mt-3 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full w-1/2 bg-gradient-to-r from-accent to-brand rounded-full"></div>
                        </div>
                    </div>

                    <!-- Card: Clínicas próximas -->
                    <div class="stat-card p-5 animate-fade-up d3">
                        <div class="flex items-start justify-between mb-4">
                            <div class="w-11 h-11 rounded-2xl bg-amber-50 flex items-center justify-center">
                                <i data-lucide="map-pin" class="w-5 h-5 text-amber-500"></i>
                            </div>
                            <span
                                class="text-xs font-semibold text-amber-600 bg-amber-50 px-2 py-1 rounded-full">Birigui,
                                SP</span>
                        </div>
                        <p class="font-display text-3xl font-bold text-slate-900">8</p>
                        <p class="text-sm text-slate-500 mt-1">Clínicas próximas</p>
                        <div class="mt-3 h-1.5 bg-slate-100 rounded-full overflow-hidden">
                            <div class="h-full w-2/3 bg-gradient-to-r from-amber-400 to-orange-400 rounded-full"></div>
                        </div>
                    </div>

                    <!-- Card: Telemedicina online -->
                    <div class="stat-card p-5 animate-fade-up d4 relative overflow-hidden">
                        <div class="absolute inset-0 bg-gradient-to-br from-brand/5 to-accent/5 pointer-events-none">
                        </div>
                        <div class="flex items-start justify-between mb-4 relative">
                            <div
                                class="w-11 h-11 rounded-2xl bg-gradient-to-br from-brand to-accent flex items-center justify-center shadow-sm">
                                <i data-lucide="video" class="w-5 h-5 text-white"></i>
                            </div>
                            <span
                                class="flex items-center gap-1.5 text-xs font-semibold text-accent bg-accent-light px-2 py-1 rounded-full">
                                <span class="online-dot" style="width:6px;height:6px;"></span>Disponível
                            </span>
                        </div>
                        <p class="font-display text-3xl font-bold text-slate-900 relative">24/7</p>
                        <p class="text-sm text-slate-500 mt-1 relative">Atendimento online</p>
                        <button class="btn-accent mt-3 w-full py-2 text-xs relative">Iniciar agora</button>
                    </div>

                </div>
            </section>
            <!-- /stats -->


            <!-- ══════════════════════════════════════════════════
         SECTION 2 — TELEMEDICINE BANNER
    ══════════════════════════════════════════════════ -->
            <section class="animate-fade-up d3">
                <div class="tele-banner p-6 sm:p-8 flex flex-col sm:flex-row items-center gap-6">

                    <!-- Text side -->
                    <div class="flex-1 relative z-10">
                        <div class="flex items-center gap-2 mb-3">
                            <span class="online-dot"></span>
                            <span class="text-white/80 text-sm font-semibold">Veterinários disponíveis agora</span>
                        </div>
                        <h2 class="font-display text-2xl sm:text-3xl font-bold text-white leading-tight mb-2">
                            Consulta online<br />disponível agora
                        </h2>
                        <p class="text-white/75 text-sm max-w-sm leading-relaxed">
                            Conecte-se em segundos com um médico veterinário. Sem filas, sem espera — cuide do seu pet
                            de onde estiver.
                        </p>
                        <div class="flex flex-wrap gap-3 mt-5">
                            <button
                                class="bg-white text-brand font-bold py-2.5 px-5 rounded-xl text-sm transition hover:bg-brand-light hover:shadow-md shadow-sm flex items-center gap-2">
                                <i data-lucide="video" class="w-4 h-4"></i>
                                Iniciar Atendimento
                            </button>
                            <button
                                class="bg-white/15 text-white font-semibold py-2.5 px-5 rounded-xl text-sm transition hover:bg-white/25 border border-white/25 flex items-center gap-2">
                                <i data-lucide="calendar-plus" class="w-4 h-4"></i>
                                Agendar horário
                            </button>
                        </div>
                    </div>

                    <!-- Illustration side -->
                    <div class="relative z-10 flex-shrink-0">
                        <div
                            class="w-28 h-28 sm:w-36 sm:h-36 rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20">
                            <img src="https://images.unsplash.com/photo-1559839734-2b71ea197ec2?auto=format&fit=crop&w=300&q=80"
                                alt="Veterinária online" class="w-full h-full object-cover" />
                        </div>
                        <!-- Online badge -->
                        <div
                            class="absolute -bottom-2 -right-2 bg-white rounded-xl px-2.5 py-1.5 shadow-lg flex items-center gap-1.5">
                            <span class="online-dot" style="width:7px;height:7px;"></span>
                            <span class="text-xs font-bold text-slate-700">Online</span>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /telemedicine -->


            <!-- ══════════════════════════════════════════════════
         SECTION 3 — MEUS PETS
    ══════════════════════════════════════════════════ -->
            <section class="animate-fade-up d4">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="font-display text-lg font-bold text-slate-900">Meus Pets</h2>
                        <p class="text-sm text-slate-400 mt-0.5">3 pets cadastrados na plataforma</p>
                    </div>
                    <button class="btn-primary py-2 px-4 text-sm flex items-center gap-2">
                        <i data-lucide="plus" class="w-4 h-4"></i>
                        <span class="hidden sm:inline">Adicionar pet</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-3 gap-5">

                    <!-- Pet 1: Mel -->
                    <div class="pet-card">
                        <div class="relative h-44 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=crop&w=600&q=80"
                                alt="Mel" class="w-full h-full object-cover" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                            </div>
                            <span
                                class="absolute top-3 right-3 badge-ok text-xs font-bold px-2.5 py-1 rounded-full">Saudável</span>
                            <div class="absolute bottom-3 left-4 text-white">
                                <p class="font-display font-bold text-lg leading-tight">Mel</p>
                                <p class="text-xs text-white/75">Golden Retriever</p>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Idade</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">3 anos</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Peso</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">28 kg</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Sexo</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">Fêmea</p>
                                </div>
                            </div>
                            <button class="btn-primary w-full py-2.5 text-sm flex items-center justify-center gap-2">
                                <i data-lucide="eye" class="w-4 h-4"></i> Ver Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Pet 2: Thor -->
                    <div class="pet-card">
                        <div class="relative h-44 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?auto=format&fit=crop&w=600&q=80"
                                alt="Thor" class="w-full h-full object-cover" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                            </div>
                            <span
                                class="absolute top-3 right-3 badge-atencao text-xs font-bold px-2.5 py-1 rounded-full">Atenção</span>
                            <div class="absolute bottom-3 left-4 text-white">
                                <p class="font-display font-bold text-lg leading-tight">Thor</p>
                                <p class="text-xs text-white/75">Labrador Retriever</p>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Idade</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">5 anos</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Peso</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">32 kg</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Sexo</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">Macho</p>
                                </div>
                            </div>
                            <button class="btn-primary w-full py-2.5 text-sm flex items-center justify-center gap-2">
                                <i data-lucide="eye" class="w-4 h-4"></i> Ver Perfil
                            </button>
                        </div>
                    </div>

                    <!-- Pet 3: Luna -->
                    <div class="pet-card">
                        <div class="relative h-44 overflow-hidden">
                            <img src="https://images.unsplash.com/photo-1533743983669-94fa5c4338ec?auto=format&fit=crop&w=600&q=80"
                                alt="Luna" class="w-full h-full object-cover" />
                            <div
                                class="absolute inset-0 bg-gradient-to-t from-black/50 via-transparent to-transparent">
                            </div>
                            <span
                                class="absolute top-3 right-3 badge-ok text-xs font-bold px-2.5 py-1 rounded-full">Saudável</span>
                            <div class="absolute bottom-3 left-4 text-white">
                                <p class="font-display font-bold text-lg leading-tight">Luna</p>
                                <p class="text-xs text-white/75">Gato Persa</p>
                            </div>
                        </div>
                        <div class="p-4">
                            <div class="grid grid-cols-3 gap-2 mb-4">
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Idade</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">2 anos</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Peso</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">4.2 kg</p>
                                </div>
                                <div class="bg-slate-50 rounded-xl p-2.5 text-center">
                                    <p class="text-xs text-slate-400 font-medium">Sexo</p>
                                    <p class="text-sm font-bold text-slate-800 mt-0.5">Fêmea</p>
                                </div>
                            </div>
                            <button class="btn-primary w-full py-2.5 text-sm flex items-center justify-center gap-2">
                                <i data-lucide="eye" class="w-4 h-4"></i> Ver Perfil
                            </button>
                        </div>
                    </div>

                </div>
            </section>
            <!-- /pets -->


            <!-- ══════════════════════════════════════════════════
         SECTION 4 — PRÓXIMAS CONSULTAS + ATIVIDADES
         Two-column grid on large screens
    ══════════════════════════════════════════════════ -->
            <section class="grid grid-cols-1 xl:grid-cols-3 gap-6 animate-fade-up d5">

                <!-- ── Próximas Consultas (2/3 width) ── -->
                <div class="xl:col-span-2 card p-6">
                    <div class="flex items-center justify-between mb-5">
                        <div>
                            <h2 class="font-display text-base font-bold text-slate-900">Próximas Consultas</h2>
                            <p class="text-xs text-slate-400 mt-0.5">3 consultas agendadas</p>
                        </div>
                        <button class="btn-ghost py-1.5 px-3 text-xs flex items-center gap-1.5">
                            <i data-lucide="calendar" class="w-3.5 h-3.5"></i> Ver todas
                        </button>
                    </div>

                    <!-- Table -->
                    <div class="scroll-x">
                        <table class="w-full min-w-[520px]">
                            <thead>
                                <tr class="border-b border-slate-100">
                                    <th class="text-left text-xs font-semibold text-slate-400 pb-3 pr-4">Pet</th>
                                    <th class="text-left text-xs font-semibold text-slate-400 pb-3 pr-4">Veterinário
                                    </th>
                                    <th class="text-left text-xs font-semibold text-slate-400 pb-3 pr-4">Data / Hora
                                    </th>
                                    <th class="text-left text-xs font-semibold text-slate-400 pb-3 pr-4">Tipo</th>
                                    <th class="text-left text-xs font-semibold text-slate-400 pb-3"></th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50">

                                <!-- Row 1 -->
                                <tr class="table-row">
                                    <td class="py-3.5 pr-4">
                                        <div class="flex items-center gap-2.5">
                                            <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=facearea&facepad=2&w=60&q=80"
                                                class="w-8 h-8 rounded-xl object-cover" alt="Mel" />
                                            <span class="text-sm font-semibold text-slate-800">Mel</span>
                                        </div>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <p class="text-sm text-slate-700 font-medium">Dr. Rafael Costa</p>
                                        <p class="text-xs text-slate-400">Clínico Geral</p>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <p class="text-sm text-slate-700 font-medium">12 mai, 2025</p>
                                        <p class="text-xs text-slate-400">14:30</p>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <span
                                            class="badge-online text-xs font-bold px-2.5 py-1 rounded-full">Online</span>
                                    </td>
                                    <td class="py-3.5">
                                        <button class="btn-ghost py-1.5 px-3 text-xs">Detalhes</button>
                                    </td>
                                </tr>

                                <!-- Row 2 -->
                                <tr class="table-row">
                                    <td class="py-3.5 pr-4">
                                        <div class="flex items-center gap-2.5">
                                            <img src="https://images.unsplash.com/photo-1518020382113-a7e8fc38eac9?auto=format&fit=facearea&facepad=2&w=60&q=80"
                                                class="w-8 h-8 rounded-xl object-cover" alt="Thor" />
                                            <span class="text-sm font-semibold text-slate-800">Thor</span>
                                        </div>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <p class="text-sm text-slate-700 font-medium">Dra. Camila Nunes</p>
                                        <p class="text-xs text-slate-400">Ortopedia</p>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <p class="text-sm text-slate-700 font-medium">15 mai, 2025</p>
                                        <p class="text-xs text-slate-400">09:00</p>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <span
                                            class="badge-presencial text-xs font-bold px-2.5 py-1 rounded-full">Presencial</span>
                                    </td>
                                    <td class="py-3.5">
                                        <button class="btn-ghost py-1.5 px-3 text-xs">Detalhes</button>
                                    </td>
                                </tr>

                                <!-- Row 3 -->
                                <tr class="table-row">
                                    <td class="py-3.5 pr-4">
                                        <div class="flex items-center gap-2.5">
                                            <img src="https://images.unsplash.com/photo-1533743983669-94fa5c4338ec?auto=format&fit=facearea&facepad=2&w=60&q=80"
                                                class="w-8 h-8 rounded-xl object-cover" alt="Luna" />
                                            <span class="text-sm font-semibold text-slate-800">Luna</span>
                                        </div>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <p class="text-sm text-slate-700 font-medium">Dr. André Lima</p>
                                        <p class="text-xs text-slate-400">Dermatologia</p>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <p class="text-sm text-slate-700 font-medium">18 mai, 2025</p>
                                        <p class="text-xs text-slate-400">16:00</p>
                                    </td>
                                    <td class="py-3.5 pr-4">
                                        <span
                                            class="badge-online text-xs font-bold px-2.5 py-1 rounded-full">Online</span>
                                    </td>
                                    <td class="py-3.5">
                                        <button class="btn-ghost py-1.5 px-3 text-xs">Detalhes</button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- ── Atividades Recentes (1/3 width) ── -->
                <div class="card p-6">
                    <div class="flex items-center justify-between mb-5">
                        <h2 class="font-display text-base font-bold text-slate-900">Atividades</h2>
                        <button class="text-xs text-brand font-semibold hover:underline">Ver tudo</button>
                    </div>

                    <div class="space-y-4">

                        <!-- Activity 1 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-accent-light flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="syringe" class="w-4 h-4 text-accent"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800">Vacina adicionada</p>
                                <p class="text-xs text-slate-500 mt-0.5">Antivírica V10 para <span
                                        class="font-medium text-slate-700">Mel</span></p>
                                <p class="text-xs text-slate-400 mt-1">Hoje · 10:24</p>
                            </div>
                        </div>

                        <div class="border-t border-slate-50"></div>

                        <!-- Activity 2 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-brand-light flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="stethoscope" class="w-4 h-4 text-brand"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800">Consulta realizada</p>
                                <p class="text-xs text-slate-500 mt-0.5">Retorno ortopedia — <span
                                        class="font-medium text-slate-700">Thor</span></p>
                                <p class="text-xs text-slate-400 mt-1">Ontem · 09:00</p>
                            </div>
                        </div>

                        <div class="border-t border-slate-50"></div>

                        <!-- Activity 3 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-pink-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="paw-print" class="w-4 h-4 text-pink-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800">Novo pet cadastrado</p>
                                <p class="text-xs text-slate-500 mt-0.5"><span
                                        class="font-medium text-slate-700">Luna</span> foi adicionada</p>
                                <p class="text-xs text-slate-400 mt-1">03 mai · 18:42</p>
                            </div>
                        </div>

                        <div class="border-t border-slate-50"></div>

                        <!-- Activity 4 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-amber-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="calendar-check" class="w-4 h-4 text-amber-500"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800">Agendamento confirmado</p>
                                <p class="text-xs text-slate-500 mt-0.5">Online · Dr. Rafael Costa</p>
                                <p class="text-xs text-slate-400 mt-1">02 mai · 14:10</p>
                            </div>
                        </div>

                        <div class="border-t border-slate-50"></div>

                        <!-- Activity 5 -->
                        <div class="flex items-start gap-3">
                            <div
                                class="w-9 h-9 rounded-xl bg-purple-50 flex items-center justify-center flex-shrink-0 mt-0.5">
                                <i data-lucide="file-text" class="w-4 h-4 text-purple-400"></i>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-semibold text-slate-800">Receita gerada</p>
                                <p class="text-xs text-slate-500 mt-0.5">Antiparasitário — <span
                                        class="font-medium text-slate-700">Mel</span></p>
                                <p class="text-xs text-slate-400 mt-1">28 abr · 11:00</p>
                            </div>
                        </div>

                    </div>
                </div>

            </section>
            <!-- /consultas + atividades -->


            <!-- ══════════════════════════════════════════════════
         SECTION 5 — CLÍNICAS PRÓXIMAS
    ══════════════════════════════════════════════════ -->
            <section class="animate-fade-up d6">
                <div class="flex items-center justify-between mb-5">
                    <div>
                        <h2 class="font-display text-lg font-bold text-slate-900">Clínicas Próximas</h2>
                        <p class="text-sm text-slate-400 mt-0.5">Birigui e região · 8 clínicas encontradas</p>
                    </div>
                    <button class="btn-ghost py-1.5 px-3 text-xs flex items-center gap-1.5">
                        <i data-lucide="map" class="w-3.5 h-3.5"></i> Ver mapa
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">

                    <!-- Clinic 1 -->
                    <div class="card p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-brand-light to-accent-light flex items-center justify-center flex-shrink-0">
                                <i data-lucide="building-2" class="w-6 h-6 text-brand"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">VetCenter Plus</p>
                                <p class="text-xs text-slate-400">Clínica geral</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="flex items-center gap-1 text-xs text-slate-500">
                                <i data-lucide="map-pin" class="w-3 h-3 text-brand"></i> 0.8 km
                            </span>
                            <span class="flex items-center gap-1 text-xs font-semibold text-amber-500">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> 4.9
                            </span>
                        </div>
                        <div class="flex items-center gap-1 mb-4">
                            <span class="online-dot" style="width:7px;height:7px;"></span>
                            <span class="text-xs text-accent font-medium">Aberta agora</span>
                        </div>
                        <button class="btn-primary w-full py-2 text-xs flex items-center justify-center gap-1.5">
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i> Ver clínica
                        </button>
                    </div>

                    <!-- Clinic 2 -->
                    <div class="card p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-gradient-to-br from-accent-light to-brand-light flex items-center justify-center flex-shrink-0">
                                <i data-lucide="building-2" class="w-6 h-6 text-accent"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">Clínica Patas & Vidas</p>
                                <p class="text-xs text-slate-400">Pequenos animais</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="flex items-center gap-1 text-xs text-slate-500">
                                <i data-lucide="map-pin" class="w-3 h-3 text-brand"></i> 1.4 km
                            </span>
                            <span class="flex items-center gap-1 text-xs font-semibold text-amber-500">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> 4.7
                            </span>
                        </div>
                        <div class="flex items-center gap-1 mb-4">
                            <span class="online-dot" style="width:7px;height:7px;"></span>
                            <span class="text-xs text-accent font-medium">Aberta agora</span>
                        </div>
                        <button class="btn-primary w-full py-2 text-xs flex items-center justify-center gap-1.5">
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i> Ver clínica
                        </button>
                    </div>

                    <!-- Clinic 3 -->
                    <div class="card p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-amber-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="building-2" class="w-6 h-6 text-amber-500"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">PetSaúde Hospital</p>
                                <p class="text-xs text-slate-400">Hospital veterinário</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="flex items-center gap-1 text-xs text-slate-500">
                                <i data-lucide="map-pin" class="w-3 h-3 text-brand"></i> 2.1 km
                            </span>
                            <span class="flex items-center gap-1 text-xs font-semibold text-amber-500">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> 4.8
                            </span>
                        </div>
                        <div class="flex items-center gap-1 mb-4">
                            <span class="w-1.5 h-1.5 rounded-full bg-amber-400"></span>
                            <span class="text-xs text-amber-500 font-medium">Abre às 14h</span>
                        </div>
                        <button class="btn-ghost w-full py-2 text-xs flex items-center justify-center gap-1.5">
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i> Ver clínica
                        </button>
                    </div>

                    <!-- Clinic 4 -->
                    <div class="card p-5 hover:shadow-lg hover:-translate-y-1 transition-all duration-200">
                        <div class="flex items-center gap-3 mb-4">
                            <div
                                class="w-12 h-12 rounded-2xl bg-purple-50 flex items-center justify-center flex-shrink-0">
                                <i data-lucide="building-2" class="w-6 h-6 text-purple-400"></i>
                            </div>
                            <div class="min-w-0">
                                <p class="text-sm font-bold text-slate-900 truncate">AnimalMed Birigui</p>
                                <p class="text-xs text-slate-400">Especialidades</p>
                            </div>
                        </div>
                        <div class="flex items-center justify-between mb-1">
                            <span class="flex items-center gap-1 text-xs text-slate-500">
                                <i data-lucide="map-pin" class="w-3 h-3 text-brand"></i> 3.5 km
                            </span>
                            <span class="flex items-center gap-1 text-xs font-semibold text-amber-500">
                                <i data-lucide="star" class="w-3 h-3 fill-amber-400 text-amber-400"></i> 4.6
                            </span>
                        </div>
                        <div class="flex items-center gap-1 mb-4">
                            <span class="online-dot" style="width:7px;height:7px;"></span>
                            <span class="text-xs text-accent font-medium">Aberta agora</span>
                        </div>
                        <button class="btn-primary w-full py-2 text-xs flex items-center justify-center gap-1.5">
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i> Ver clínica
                        </button>
                    </div>

                </div>
            </section>
            <!-- /clinicas -->


            <!-- ══════════════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════════════ -->
            <footer
                class="border-t border-slate-100 pt-6 pb-2 flex flex-col sm:flex-row items-center justify-between gap-3">
                <div class="flex items-center gap-2">
                    <div
                        class="w-6 h-6 rounded-lg bg-gradient-to-br from-brand to-accent flex items-center justify-center">
                        <i data-lucide="heart-pulse" class="w-3.5 h-3.5 text-white"></i>
                    </div>
                    <span class="font-display text-sm font-bold text-slate-700">VetTech</span>
                    <span class="text-xs text-slate-400">© 2025 · Todos os direitos reservados</span>
                </div>
                <div class="flex items-center gap-4">
                    <a href="#" class="text-xs text-slate-400 hover:text-slate-600 transition-colors">Termos</a>
                    <a href="#"
                        class="text-xs text-slate-400 hover:text-slate-600 transition-colors">Privacidade</a>
                    <a href="#"
                        class="text-xs text-slate-400 hover:text-slate-600 transition-colors">Suporte</a>
                </div>
            </footer>

        </main>
        <!-- /page body -->

    </div>
    <!-- /main content -->


    <!-- ═══════════════════════════════════════════════════════════
     JAVASCRIPT — sidebar, navigation, interactions
═══════════════════════════════════════════════════════════ -->
    <script>
        /* ─── Init Lucide ─── */
        lucide.createIcons();

        /* ─────────────────────────────────────
           SIDEBAR — Mobile open/close
        ───────────────────────────────────── */
        const sidebar = document.getElementById('sidebar');
        const sidebarOverlay = document.getElementById('sidebarOverlay');

        function openSidebar() {
            sidebar.classList.remove('mobile-hidden');
            sidebarOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeSidebar() {
            sidebar.classList.add('mobile-hidden');
            sidebarOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        /* Close on resize to desktop */
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 1024) {
                sidebarOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });

        /* ─────────────────────────────────────
           SIDEBAR — Desktop collapse/expand
        ───────────────────────────────────── */
        const mainContent = document.getElementById('mainContent');
        const collapseBtn = document.getElementById('collapseBtn');
        let collapsed = false;

        function toggleCollapse() {
            collapsed = !collapsed;
            sidebar.classList.toggle('collapsed', collapsed);
            mainContent.classList.toggle('sidebar-collapsed', collapsed);

            /* Swap icon */
            collapseBtn.querySelector('i').setAttribute(
                'data-lucide',
                collapsed ? 'panel-left-open' : 'panel-left-close'
            );
            lucide.createIcons();
        }

        /* ─────────────────────────────────────
           NAVIGATION — Active state
        ───────────────────────────────────── */
        document.querySelectorAll('.nav-item[data-section]').forEach(item => {
            item.addEventListener('click', (e) => {
                if (item.href && item.href !== '#') return; // let real links work
                e.preventDefault();
                document.querySelectorAll('.nav-item').forEach(i => i.classList.remove('active'));
                item.classList.add('active');
                /* Close mobile sidebar after nav */
                if (window.innerWidth < 1024) closeSidebar();
            });
        });

        /* ─────────────────────────────────────
           STAT COUNTER ANIMATION
        ───────────────────────────────────── */
        function animateCount(el, target, duration = 900) {
            const start = performance.now();
            const update = (now) => {
                const elapsed = now - start;
                const progress = Math.min(elapsed / duration, 1);
                const ease = 1 - Math.pow(1 - progress, 3); // ease-out cubic
                el.textContent = Math.round(ease * target);
                if (progress < 1) requestAnimationFrame(update);
            };
            requestAnimationFrame(update);
        }

        /* Trigger counters when visible */
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    const targets = {
                        stat0: 3,
                        stat1: 12,
                        stat2: 8
                    };
                    Object.entries(targets).forEach(([id, val]) => {
                        const el = document.getElementById(id);
                        if (el) animateCount(el, val);
                    });
                    observer.disconnect();
                }
            });
        }, {
            threshold: 0.3
        });

        const firstCard = document.querySelector('.stat-card');
        if (firstCard) observer.observe(firstCard);
    </script>

</body>

</html>
