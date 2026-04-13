<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetTech — Cuidado veterinário rápido, onde você estiver</title>

    <!-- Tailwind CSS via CDN Play -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Google Fonts: DM Sans (corpo) + Syne (display) -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;700&family=Syne:wght@700;800&display=swap"
        rel="stylesheet" />

    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- Configuração personalizada do Tailwind -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563EB',
                        'primary-dark': '#1d4ed8',
                        'primary-light': '#eff6ff',
                        accent: '#10B981',
                        'accent-dark': '#059669',
                        'gray-soft': '#F8FAFC',
                    },
                    fontFamily: {
                        sans: ['DM Sans', 'sans-serif'],
                        display: ['Syne', 'sans-serif'],
                    },
                    animation: {
                        'fade-up': 'fadeUp 0.6s ease forwards',
                        'fade-in': 'fadeIn 0.5s ease forwards',
                        'pulse-slow': 'pulse 3s ease-in-out infinite',
                    },
                    keyframes: {
                        fadeUp: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(28px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        },
                        fadeIn: {
                            '0%': {
                                opacity: '0'
                            },
                            '100%': {
                                opacity: '1'
                            },
                        },
                    },
                },
            },
        };
    </script>

    <style>
        /* ═══════════════════════════════════════════════
        ESTILOS GLOBAIS E UTILITÁRIOS CUSTOMIZADOS
    ═══════════════════════════════════════════════ */

        * {
            box-sizing: border-box;
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: #fff;
            color: #1e293b;
            overflow-x: hidden;
        }

        /* Navbar com backdrop blur */
        .navbar-blur {
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            background: rgba(255, 255, 255, 0.88);
            border-bottom: 1px solid rgba(37, 99, 235, 0.08);
        }

        /* Gradiente decorativo hero */
        .hero-overlay {
            background: linear-gradient(135deg,
                    rgba(10, 20, 50, 0.72) 0%,
                    rgba(37, 99, 235, 0.38) 60%,
                    rgba(16, 185, 129, 0.22) 100%);
        }

        /* Linha de destaque colorido no título */
        .headline-mark {
            background: linear-gradient(90deg, #2563EB, #10B981);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        /* Card de benefício com borda animada no hover */
        .benefit-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease;
            border: 1.5px solid transparent;
        }

        .benefit-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 20px 40px rgba(37, 99, 235, 0.12);
            border-color: #2563EB;
        }

        /* Botão primário */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB, #1d4ed8);
            transition: all 0.25s ease;
            box-shadow: 0 4px 18px rgba(37, 99, 235, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(37, 99, 235, 0.45);
        }

        /* Botão verde / acento */
        .btn-accent {
            background: linear-gradient(135deg, #10B981, #059669);
            transition: all 0.25s ease;
            box-shadow: 0 4px 18px rgba(16, 185, 129, 0.35);
        }

        .btn-accent:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 28px rgba(16, 185, 129, 0.45);
        }

        /* Botão outline branco (hero) */
        .btn-outline-white {
            border: 2px solid rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(8px);
            background: rgba(255, 255, 255, 0.1);
            transition: all 0.25s ease;
        }

        .btn-outline-white:hover {
            background: rgba(255, 255, 255, 0.22);
            border-color: #fff;
            transform: translateY(-2px);
        }

        /* Step card presencial */
        .step-card-blue {
            border-top: 3px solid #2563EB;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .step-card-blue:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(37, 99, 235, 0.14);
        }

        /* Step card online */
        .step-card-green {
            border-top: 3px solid #10B981;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .step-card-green:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(16, 185, 129, 0.14);
        }

        /* Badge de passo numerado */
        .step-badge-blue {
            background: linear-gradient(135deg, #2563EB, #1d4ed8);
        }

        .step-badge-green {
            background: linear-gradient(135deg, #10B981, #059669);
        }

        /* Depoimento card */
        .testimonial-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 16px 40px rgba(0, 0, 0, 0.10);
        }

        /* Seção gradiente de fundo suave */
        .section-soft {
            background: linear-gradient(180deg, #F8FAFC 0%, #fff 100%);
        }

        /* Seção telemedicina fundo azul escuro */
        .telemedicine-bg {
            background: linear-gradient(135deg, #0f172a 0%, #1e3a8a 60%, #1d4ed8 100%);
        }

        /* CTA final */
        .cta-bg {
            background: linear-gradient(135deg, #10B981 0%, #2563EB 100%);
        }

        /* Animação de entrada via IntersectionObserver */
        .reveal {
            opacity: 0;
            transform: translateY(30px);
            transition: opacity 0.65s ease, transform 0.65s ease;
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* Atraso escalonado para filhos */
        .reveal-stagger>*:nth-child(1) {
            transition-delay: 0.05s;
        }

        .reveal-stagger>*:nth-child(2) {
            transition-delay: 0.15s;
        }

        .reveal-stagger>*:nth-child(3) {
            transition-delay: 0.25s;
        }

        .reveal-stagger>*:nth-child(4) {
            transition-delay: 0.35s;
        }

        /* Input de busca hero */
        .hero-input {
            background: rgba(255, 255, 255, 0.95);
            border: 2px solid transparent;
            transition: border-color 0.2s ease, box-shadow 0.2s ease;
        }

        .hero-input:focus {
            outline: none;
            border-color: #10B981;
            box-shadow: 0 0 0 4px rgba(16, 185, 129, 0.18);
        }

        /* Menu hamburguer mobile */
        #mobile-menu {
            display: none;
        }

        #mobile-menu.open {
            display: flex;
        }

        /* Linha separadora decorativa */
        .divider-gradient {
            height: 3px;
            background: linear-gradient(90deg, #2563EB, #10B981);
            border-radius: 999px;
        }

        /* Pill badge */
        .pill-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 14px;
            border-radius: 999px;
            font-size: 0.78rem;
            font-weight: 700;
            letter-spacing: 0.04em;
            text-transform: uppercase;
        }

        /* Clínica card na seção simulada */
        .clinic-card {
            border: 1.5px solid #e2e8f0;
            transition: border-color 0.2s ease, box-shadow 0.2s ease, transform 0.2s ease;
        }

        .clinic-card:hover {
            border-color: #2563EB;
            box-shadow: 0 8px 28px rgba(37, 99, 235, 0.10);
            transform: translateY(-3px);
        }

        /* Rating estrelas */
        .star {
            color: #f59e0b;
        }

        /* Número de estatística */
        .stat-num {
            font-family: 'Syne', sans-serif;
            font-weight: 800;
        }
    </style>
</head>

<body>

    <!-- ═══════════════════════════════════════════════
        NAVBAR FIXA
    ═══════════════════════════════════════════════ -->
    <header class="navbar-blur fixed top-0 left-0 right-0 z-50">
        <nav class="max-w-7xl mx-auto px-5 flex items-center justify-between h-16">

            <!-- Logo -->
            <a href="#inicio" class="flex items-center gap-2 font-display text-xl font-bold text-slate-900">
                <span class="w-8 h-8 rounded-lg btn-primary flex items-center justify-center">
                    <i data-lucide="heart-pulse" class="w-4 h-4 text-white"></i>
                </span>
                Vet<span class="headline-mark">Tech</span>
            </a>

            <!-- Menu desktop -->
            <ul class="hidden md:flex items-center gap-7 text-sm font-medium text-slate-600">
                <li><a href="#inicio" class="hover:text-primary transition-colors">Início</a></li>
                <li><a href="#como-funciona" class="hover:text-primary transition-colors">Como Funciona</a></li>
                <li><a href="#beneficios" class="hover:text-primary transition-colors">Benefícios</a></li>
                <li><a href="#telemedicina" class="hover:text-primary transition-colors">Telemedicina</a></li>
                <li><a href="#clinicas" class="hover:text-primary transition-colors">Clínicas</a></li>
                <li><a href="#contato" class="hover:text-primary transition-colors">Contato</a></li>
            </ul>

            <!-- CTA Navbar -->
            <a href="{{ route('login') }}"
                class="hidden md:inline-flex items-center gap-2 btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded-full">
                <i data-lucide="search" class="w-4 h-4"></i>
                Buscar Atendimento
            </a>

            <!-- Botão hamburguer mobile -->
            <button id="hamburger" class="md:hidden p-2 rounded-lg text-slate-600 hover:bg-slate-100 transition-colors">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>
        </nav>

        <!-- Menu mobile expansível -->
        <div id="mobile-menu" class="flex-col gap-1 px-5 pb-4 md:hidden bg-white border-t border-slate-100">
            <a href="#inicio" class="block py-2 text-sm font-medium text-slate-700 hover:text-primary">Início</a>
            <a href="#como-funciona" class="block py-2 text-sm font-medium text-slate-700 hover:text-primary">Como
                Funciona</a>
            <a href="#beneficios"
                class="block py-2 text-sm font-medium text-slate-700 hover:text-primary">Benefícios</a>
            <a href="#telemedicina"
                class="block py-2 text-sm font-medium text-slate-700 hover:text-primary">Telemedicina</a>
            <a href="#clinicas" class="block py-2 text-sm font-medium text-slate-700 hover:text-primary">Clínicas</a>
            <a href="#contato" class="block py-2 text-sm font-medium text-slate-700 hover:text-primary">Contato</a>
            <a href="#buscar"
                class="mt-2 inline-flex items-center gap-2 btn-primary text-white text-sm font-semibold px-5 py-2.5 rounded-full w-full justify-center">
                <i data-lucide="search" class="w-4 h-4"></i>
                Buscar Atendimento
            </a>
        </div>
    </header>
    <!-- /NAVBAR -->


    <!-- ═══════════════════════════════════════════════
        HERO SECTION
    ═══════════════════════════════════════════════ -->
    <section id="inicio" class="relative min-h-screen flex items-center pt-16">

        <!-- Imagem de fundo (Unsplash — veterinária com pet) -->
        <!-- TODO: Substituir pela URL real do sistema -->
        <img src="https://images.unsplash.com/photo-1612349317150-e413f6a5b16d?auto=format&fit=crop&w=1920&q=80"
            alt="Veterinária cuidando de um cachorro"
            class="absolute inset-0 w-full h-full object-cover object-center" />

        <!-- Overlay gradiente -->
        <div class="hero-overlay absolute inset-0"></div>

        <!-- Conteúdo hero -->
        <div class="relative z-10 max-w-7xl mx-auto px-5 py-20 w-full">
            <div class="max-w-2xl">

                <!-- Pill badge -->
                <div class="pill-badge bg-accent/20 text-accent mb-6 animate-fade-in">
                    <i data-lucide="zap" class="w-3.5 h-3.5"></i>
                    Atendimento em minutos
                </div>

                <!-- Headline -->
                <h1
                    class="font-display text-4xl md:text-6xl font-extrabold text-white leading-tight mb-6 animate-fade-up">
                    Cuidado veterinário <br />
                    <span style="color: #10B981;">rápido,</span> onde<br />
                    você estiver.
                </h1>

                <!-- Subtítulo -->
                <p class="text-lg md:text-xl text-white/85 mb-10 leading-relaxed"
                    style="animation: fadeUp 0.7s ease 0.2s forwards; opacity:0;">
                    Encontre clínicas próximas ou fale com um veterinário
                    <strong class="text-white">online em minutos</strong>. Seu pet merece o melhor.
                </p>

                <!-- Campo de busca -->
                <div id="buscar"
                    class="bg-white rounded-2xl shadow-2xl p-2 flex flex-col sm:flex-row gap-2 mb-6 max-w-lg"
                    style="animation: fadeUp 0.7s ease 0.35s forwards; opacity:0;">

                    <!-- Ícone de localização -->
                    <div class="flex items-center gap-2 flex-1 px-3">
                        <i data-lucide="map-pin" class="w-5 h-5 text-primary shrink-0"></i>
                        <input type="text" placeholder="Digite sua cidade ou CEP..."
                            class="hero-input w-full py-2.5 text-slate-800 text-sm rounded-lg bg-transparent focus:outline-none" />
                    </div>

                    <!-- Botão buscar -->
                    <!-- TODO: Substituir pelo endpoint real de busca de clínicas -->
                    <button
                        class="btn-primary text-white font-semibold px-6 py-3 rounded-xl text-sm whitespace-nowrap flex items-center gap-2">
                        <i data-lucide="search" class="w-4 h-4"></i>
                        Buscar clínicas
                </button>
                </div>

                <!-- Dois CTAs secundários -->
                <div class="flex flex-wrap gap-3" style="animation: fadeUp 0.7s ease 0.5s forwards; opacity:0;">

                    <!-- TODO: Substituir pela URL real do sistema -->
                    <a href="{{ route('clinicas.buscar') }}">Buscar clínicas</a>
                        class="btn-outline-white text-white font-semibold px-6 py-3 rounded-full text-sm flex items-center gap-2">
                        <i data-lucide="building-2" class="w-4 h-4"></i>
                        Ver clínicas próximas
                    </a>

                    <!-- TODO: Substituir pela URL real do sistema -->
                    <a href="{{ route('telemedicina.index') }}">Falar com veterinário</a>
                        class="btn-accent text-white font-semibold px-6 py-3 rounded-full text-sm flex items-center gap-2">
                        <i data-lucide="video" class="w-4 h-4"></i>
                        Falar com veterinário
                    </a>
                </div>

            </div><!-- /col -->

            <!-- Mini stats flutuantes (decorativo) -->
            <div class="absolute bottom-10 right-5 hidden lg:flex flex-col gap-3">
                <div class="bg-white/95 backdrop-blur rounded-xl p-4 shadow-xl flex items-center gap-3 w-52">
                    <span class="w-10 h-10 rounded-lg bg-primary-light flex items-center justify-center shrink-0">
                        <i data-lucide="shield-check" class="w-5 h-5 text-primary"></i>
                    </span>
                    <div>
                        <p class="font-bold text-slate-800 text-sm">Profissionais verificados</p>
                        <p class="text-xs text-slate-500">100% credenciados</p>
                    </div>
                </div>
                <div class="bg-white/95 backdrop-blur rounded-xl p-4 shadow-xl flex items-center gap-3 w-52">
                    <span class="w-10 h-10 rounded-lg bg-emerald-50 flex items-center justify-center shrink-0">
                        <i data-lucide="clock" class="w-5 h-5 text-accent"></i>
                    </span>
                    <div>
                        <p class="font-bold text-slate-800 text-sm">Atendimento em</p>
                        <p class="text-xs text-slate-500">menos de 5 minutos</p>
                    </div>
                </div>
            </div>

        </div><!-- /max-w -->
    </section>
    <!-- /HERO -->


    <!-- ═══════════════════════════════════════════════
       COMO FUNCIONA
  ═══════════════════════════════════════════════ -->
    <section id="como-funciona" class="section-soft py-24">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Cabeçalho da seção -->
            <div class="text-center mb-16 reveal">
                <div class="pill-badge bg-primary-light text-primary mb-4 mx-auto w-fit">
                    <i data-lucide="layers" class="w-3.5 h-3.5"></i>
                    Simples e intuitivo
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                    Como funciona o <span class="headline-mark">VetTech</span>?
                </h2>
                <p class="text-slate-500 max-w-xl mx-auto">
                    Dois modos de atendimento integrados para cuidar do seu pet com praticidade e eficiência.
                </p>
            </div>

            <!-- Grade dos dois fluxos -->
            <div class="grid md:grid-cols-2 gap-8">

                <!-- ── Fluxo 1: Presencial ── -->
                <div class="reveal">
                    <!-- Header do fluxo -->
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-10 h-10 rounded-full step-badge-blue flex items-center justify-center">
                            <i data-lucide="building-2" class="w-5 h-5 text-white"></i>
                        </span>
                        <div>
                            <h3 class="font-display text-xl font-bold text-slate-900">Atendimento Presencial</h3>
                            <p class="text-sm text-slate-500">Encontre clínicas perto de você</p>
                        </div>
                    </div>

                    <!-- Passos presenciais -->
                    <div class="flex flex-col gap-4 reveal-stagger">

                        <div class="step-card-blue bg-white rounded-2xl p-5 flex gap-4 shadow-sm">
                            <span
                                class="step-badge-blue w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">1</span>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="map-pin" class="w-4 h-4 text-primary"></i>
                                    <h4 class="font-semibold text-slate-800">Informe sua localização</h4>
                                </div>
                                <p class="text-sm text-slate-500">Digite sua cidade, endereço ou CEP no campo de busca.
                                </p>
                            </div>
                        </div>

                        <div class="step-card-blue bg-white rounded-2xl p-5 flex gap-4 shadow-sm">
                            <span
                                class="step-badge-blue w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">2</span>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="list" class="w-4 h-4 text-primary"></i>
                                    <h4 class="font-semibold text-slate-800">Veja clínicas próximas</h4>
                                </div>
                                <p class="text-sm text-slate-500">Receba uma lista de clínicas verificadas com
                                    informações completas.</p>
                            </div>
                        </div>

                        <div class="step-card-blue bg-white rounded-2xl p-5 flex gap-4 shadow-sm">
                            <span
                                class="step-badge-blue w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">3</span>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="navigation" class="w-4 h-4 text-primary"></i>
                                    <h4 class="font-semibold text-slate-800">Vá até o local</h4>
                                </div>
                                <p class="text-sm text-slate-500">Use o mapa integrado para chegar com facilidade à
                                    clínica escolhida.</p>
                            </div>
                        </div>

                    </div><!-- /steps presencial -->
                </div>
                <!-- /Fluxo Presencial -->

                <!-- ── Fluxo 2: Online ── -->
                <div class="reveal">
                    <!-- Header do fluxo -->
                    <div class="flex items-center gap-3 mb-6">
                        <span class="w-10 h-10 rounded-full step-badge-green flex items-center justify-center">
                            <i data-lucide="video" class="w-5 h-5 text-white"></i>
                        </span>
                        <div>
                            <h3 class="font-display text-xl font-bold text-slate-900">Atendimento Online</h3>
                            <p class="text-sm text-slate-500">Telemedicina veterinária ao vivo</p>
                        </div>
                    </div>

                    <!-- Passos online -->
                    <div class="flex flex-col gap-4 reveal-stagger">

                        <div class="step-card-green bg-white rounded-2xl p-5 flex gap-4 shadow-sm">
                            <span
                                class="step-badge-green w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">1</span>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="mouse-pointer-click" class="w-4 h-4 text-accent"></i>
                                    <h4 class="font-semibold text-slate-800">Escolha atendimento online</h4>
                                </div>
                                <p class="text-sm text-slate-500">Selecione a opção de telemedicina e informe o sintoma
                                    do seu pet.</p>
                            </div>
                        </div>

                        <div class="step-card-green bg-white rounded-2xl p-5 flex gap-4 shadow-sm">
                            <span
                                class="step-badge-green w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">2</span>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="wifi" class="w-4 h-4 text-accent"></i>
                                    <h4 class="font-semibold text-slate-800">Conecte-se com um veterinário</h4>
                                </div>
                                <p class="text-sm text-slate-500">Um veterinário credenciado iniciará a consulta por
                                    vídeo ou chat.</p>
                            </div>
                        </div>

                        <div class="step-card-green bg-white rounded-2xl p-5 flex gap-4 shadow-sm">
                            <span
                                class="step-badge-green w-8 h-8 rounded-full flex items-center justify-center text-white font-bold text-sm shrink-0">3</span>
                            <div>
                                <div class="flex items-center gap-2 mb-1">
                                    <i data-lucide="message-circle-check" class="w-4 h-4 text-accent"></i>
                                    <h4 class="font-semibold text-slate-800">Receba orientação imediata</h4>
                                </div>
                                <p class="text-sm text-slate-500">Obtenha diagnóstico, orientações e prescrição sem
                                    sair de casa.</p>
                            </div>
                        </div>

                    </div><!-- /steps online -->
                </div>
                <!-- /Fluxo Online -->

            </div><!-- /grid fluxos -->
        </div><!-- /max-w -->
    </section>
    <!-- /COMO FUNCIONA -->


    <!-- ═══════════════════════════════════════════════
       BENEFÍCIOS
  ═══════════════════════════════════════════════ -->
    <section id="beneficios" class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Cabeçalho -->
            <div class="text-center mb-16 reveal">
                <div class="pill-badge bg-emerald-50 text-accent mb-4 mx-auto w-fit">
                    <i data-lucide="star" class="w-3.5 h-3.5"></i>
                    Diferenciais
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                    Por que escolher o <span class="headline-mark">VetTech</span>?
                </h2>
                <p class="text-slate-500 max-w-xl mx-auto">
                    Pensamos em cada detalhe para que você e seu pet tenham a melhor experiência.
                </p>
            </div>

            <!-- Grid de cards de benefícios -->
            <div class="grid sm:grid-cols-2 lg:grid-cols-4 gap-6 reveal reveal-stagger">

                <!-- Card 1 -->
                <div class="benefit-card bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-primary-light flex items-center justify-center mb-4">
                        <i data-lucide="video" class="w-6 h-6 text-primary"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Atendimento online imediato</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Consulte um veterinário credenciado por vídeo ou chat, a qualquer hora, sem filas.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="benefit-card bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-emerald-50 flex items-center justify-center mb-4">
                        <i data-lucide="map-pin" class="w-6 h-6 text-accent"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Clínicas próximas em segundos</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Busca inteligente por geolocalização, cidade ou CEP. Encontre a clínica ideal rapidamente.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="benefit-card bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-amber-50 flex items-center justify-center mb-4">
                        <i data-lucide="zap" class="w-6 h-6 text-amber-500"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Praticidade e rapidez</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Interface simples e intuitiva. Do problema ao atendimento em poucos toques na tela.
                    </p>
                </div>

                <!-- Card 4 -->
                <div class="benefit-card bg-white rounded-2xl p-6 shadow-md">
                    <div class="w-12 h-12 rounded-xl bg-rose-50 flex items-center justify-center mb-4">
                        <i data-lucide="shield-check" class="w-6 h-6 text-rose-500"></i>
                    </div>
                    <h3 class="font-bold text-slate-900 mb-2">Segurança para seu pet</h3>
                    <p class="text-sm text-slate-500 leading-relaxed">
                        Todos os veterinários são verificados. Clínicas cadastradas e avaliadas pela comunidade.
                    </p>
                </div>

            </div><!-- /grid benefícios -->
        </div>
    </section>
    <!-- /BENEFÍCIOS -->


    <!-- ═══════════════════════════════════════════════
       TELEMEDICINA VETERINÁRIA
  ═══════════════════════════════════════════════ -->
    <section id="telemedicina" class="telemedicine-bg py-24">
        <div class="max-w-7xl mx-auto px-5">
            <div class="grid md:grid-cols-2 gap-12 items-center">

                <!-- Texto -->
                <div class="reveal">
                    <div class="pill-badge bg-white/10 text-white mb-6 w-fit">
                        <i data-lucide="video" class="w-3.5 h-3.5"></i>
                        Telemedicina Veterinária
                    </div>

                    <h2 class="font-display text-3xl md:text-4xl font-extrabold text-white mb-5 leading-tight">
                        Cuide do seu pet sem<br />
                        <span style="color: #10B981;">sair de casa</span>
                    </h2>

                    <p class="text-white/75 mb-8 leading-relaxed">
                        A telemedicina VetTech conecta você a veterinários experientes em tempo real.
                        Ideal para tirar dúvidas, triagem de sintomas e orientações rápidas — sem stress
                        para você ou para o seu animal.
                    </p>

                    <!-- Features da telemedicina -->
                    <ul class="space-y-4 mb-8">
                        <li class="flex items-start gap-3">
                            <span
                                class="w-6 h-6 rounded-full bg-accent flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                            </span>
                            <div>
                                <p class="font-semibold text-white">Atendimento remoto por vídeo ou chat</p>
                                <p class="text-sm text-white/60">Consulta ao vivo com veterinário credenciado</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="w-6 h-6 rounded-full bg-accent flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                            </span>
                            <div>
                                <p class="font-semibold text-white">Orientações rápidas e precisas</p>
                                <p class="text-sm text-white/60">Diagnóstico inicial, cuidados e prescrição</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="w-6 h-6 rounded-full bg-accent flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                            </span>
                            <div>
                                <p class="font-semibold text-white">Ideal para dúvidas e triagem</p>
                                <p class="text-sm text-white/60">Saiba se é urgente ou pode aguardar consulta
                                    presencial</p>
                            </div>
                        </li>
                        <li class="flex items-start gap-3">
                            <span
                                class="w-6 h-6 rounded-full bg-accent flex items-center justify-center shrink-0 mt-0.5">
                                <i data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                            </span>
                            <div>
                                <p class="font-semibold text-white">Disponível 24h, 7 dias por semana</p>
                                <p class="text-sm text-white/60">Emergências não têm hora. Nós também não.</p>
                            </div>
                        </li>
                    </ul>

                    <!-- TODO: Substituir pela URL real do sistema -->
                    <a href="#"
                        class="btn-accent inline-flex items-center gap-2 text-white font-semibold px-7 py-3.5 rounded-full">
                        <i data-lucide="video" class="w-4 h-4"></i>
                        Iniciar consulta online
                    </a>
                </div>

                <!-- Imagem telemedicina -->
                <div class="reveal">
                    <div class="relative">
                        <!-- Imagem principal -->
                        <!-- TODO: Substituir pela URL real do sistema -->
                        <img src="https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=crop&w=800&q=80"
                            alt="Veterinário em consulta online"
                            class="w-full rounded-3xl shadow-2xl object-cover aspect-[4/3]" />
                        <!-- Badge flutuante -->
                        <div
                            class="absolute -bottom-5 -left-5 bg-white rounded-2xl shadow-xl p-4 flex items-center gap-3">
                            <div class="w-3 h-3 rounded-full bg-accent animate-pulse-slow"></div>
                            <div>
                                <p class="font-bold text-slate-800 text-sm">Veterinário online agora</p>
                                <p class="text-xs text-slate-500">Tempo médio: &lt; 5 minutos</p>
                            </div>
                        </div>
                    </div>
                </div>

            </div><!-- /grid -->
        </div>
    </section>
    <!-- /TELEMEDICINA -->


    <!-- ═══════════════════════════════════════════════
       PARA QUEM É
  ═══════════════════════════════════════════════ -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Cabeçalho -->
            <div class="text-center mb-16 reveal">
                <div class="pill-badge bg-slate-100 text-slate-600 mb-4 mx-auto w-fit">
                    <i data-lucide="users" class="w-3.5 h-3.5"></i>
                    Público
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                    Para quem é o <span class="headline-mark">VetTech</span>?
                </h2>
            </div>

            <!-- Cards de público -->
            <div class="grid md:grid-cols-3 gap-6 reveal reveal-stagger">

                <!-- Donos de pets -->
                <div class="rounded-3xl overflow-hidden shadow-lg group cursor-default">
                    <div class="relative h-48 overflow-hidden">
                        <!-- TODO: Substituir pela URL real do sistema -->
                        <img src="https://images.unsplash.com/photo-1601758124510-52d02ddb7cbd?auto=format&fit=crop&w=600&q=80"
                            alt="Dona de pet com cachorro"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 font-display text-lg font-bold text-white">Donos de
                            pets</span>
                    </div>
                    <div class="p-5 bg-white border border-slate-100">
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Para quem ama seus animais e quer acesso rápido e confiável ao atendimento veterinário,
                            online ou presencial.
                        </p>
                    </div>
                </div>

                <!-- Emergências -->
                <div class="rounded-3xl overflow-hidden shadow-lg group cursor-default">
                    <div class="relative h-48 overflow-hidden">
                        <!-- TODO: Substituir pela URL real do sistema -->
                        <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?auto=format&fit=crop&w=600&q=80"
                            alt="Veterinário em atendimento emergencial"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 font-display text-lg font-bold text-white">Situações de
                            emergência</span>
                    </div>
                    <div class="p-5 bg-white border border-slate-100">
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Quando cada minuto importa. Localize atendimento emergencial 24h próximo de você em
                            segundos.
                        </p>
                    </div>
                </div>

                <!-- Clínicas e vets -->
                <div class="rounded-3xl overflow-hidden shadow-lg group cursor-default">
                    <div class="relative h-48 overflow-hidden">
                        <!-- TODO: Substituir pela URL real do sistema -->
                        <img src="https://images.unsplash.com/photo-1631815589968-fdb09a223b1e?auto=format&fit=crop&w=600&q=80"
                            alt="Clínica veterinária moderna"
                            class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105" />
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/70 to-transparent"></div>
                        <span class="absolute bottom-4 left-4 font-display text-lg font-bold text-white">Clínicas e
                            veterinários</span>
                    </div>
                    <div class="p-5 bg-white border border-slate-100">
                        <p class="text-sm text-slate-600 leading-relaxed">
                            Amplie o alcance da sua clínica, gerencie consultas online e conecte-se com novos clientes
                            na sua região.
                        </p>
                    </div>
                </div>

            </div><!-- /grid público -->
        </div>
    </section>
    <!-- /PARA QUEM É -->


    <!-- ═══════════════════════════════════════════════
       CLÍNICAS SIMULADAS (UI Visual)
  ═══════════════════════════════════════════════ -->
    <section id="clinicas" class="section-soft py-24">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Cabeçalho -->
            <div class="text-center mb-12 reveal">
                <div class="pill-badge bg-primary-light text-primary mb-4 mx-auto w-fit">
                    <i data-lucide="building-2" class="w-3.5 h-3.5"></i>
                    Clínicas próximas
                </div>
                <h2 class="font-display text-3xl md:text-4xl font-extrabold text-slate-900 mb-4">
                    Encontre clínicas <span class="headline-mark">verificadas</span>
                </h2>
                <p class="text-slate-500 max-w-xl mx-auto">
                    Veja abaixo exemplos de clínicas cadastradas na plataforma. Busque pela sua região para ver
                    resultados reais.
                </p>
            </div>

            <!-- Barra de busca simulada -->
            <div class="flex flex-col sm:flex-row gap-2 max-w-2xl mx-auto mb-10 reveal">
                <div
                    class="flex items-center gap-2 bg-white border-2 border-slate-200 rounded-xl px-4 py-3 flex-1 focus-within:border-primary transition-colors">
                    <i data-lucide="search" class="w-4 h-4 text-slate-400 shrink-0"></i>
                    <input type="text" placeholder="Buscar por cidade, bairro ou CEP..."
                        class="w-full text-sm text-slate-700 bg-transparent focus:outline-none placeholder-slate-400"
                        value="São Paulo, SP" />
                </div>
                <!-- TODO: Substituir pelo endpoint real de busca de clínicas -->
                <button
                    class="btn-primary text-white font-semibold px-6 py-3 rounded-xl text-sm flex items-center gap-2 justify-center">
                    <i data-lucide="search" class="w-4 h-4"></i>
                    Buscar
                </button>
            </div>

            <!-- Lista de clínicas (visual simulado) -->
            <div class="grid md:grid-cols-3 gap-5 reveal reveal-stagger">

                <!-- Clínica 1 -->
                <div class="clinic-card bg-white rounded-2xl overflow-hidden shadow-sm">
                    <div class="h-36 overflow-hidden">
                        <!-- TODO: Substituir pela URL real do sistema -->
                        <img src="https://images.unsplash.com/photo-1516兒69_disabled_2.jpg?auto=format&fit=crop&w=600&q=80"
                            onerror="this.style.background='linear-gradient(135deg,#eff6ff,#dbeafe)'; this.alt=''"
                            alt="Clínica VetCare" class="w-full h-full object-cover" />
                        <div
                            class="w-full h-full bg-gradient-to-br from-primary-light to-blue-100 flex items-center justify-center -mt-36">
                            <i data-lucide="building-2" class="w-12 h-12 text-primary opacity-40"></i>
                        </div>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h4 class="font-bold text-slate-800">VetCare Premium</h4>
                            <span class="pill-badge bg-emerald-50 text-accent text-xs shrink-0">Aberto</span>
                        </div>
                        <div class="flex items-center gap-1 mb-3">
                            <span class="star">★</span><span class="star">★</span><span
                                class="star">★</span><span class="star">★</span><span class="star">★</span>
                            <span class="text-xs text-slate-500 ml-1">4.9 (312 avaliações)</span>
                        </div>
                        <div class="space-y-1.5 text-sm text-slate-500 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-primary shrink-0"></i>
                                Av. Paulista, 1578 — Bela Vista
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-primary shrink-0"></i>
                                (11) 3456-7890
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-primary shrink-0"></i>
                                Seg–Sex 8h–20h | Sáb 8h–14h
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-1 border border-primary text-primary text-xs font-semibold py-2 rounded-lg hover:bg-primary-light transition-colors">Ver
                                detalhes</button>
                            <button class="flex-1 btn-primary text-white text-xs font-semibold py-2 rounded-lg">Como
                                chegar</button>
                        </div>
                    </div>
                </div>

                <!-- Clínica 2 -->
                <div class="clinic-card bg-white rounded-2xl overflow-hidden shadow-sm">
                    <div class="h-36 bg-gradient-to-br from-emerald-50 to-teal-100 flex items-center justify-center">
                        <i data-lucide="heart-pulse" class="w-12 h-12 text-accent opacity-40"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h4 class="font-bold text-slate-800">Clínica PetLife</h4>
                            <span class="pill-badge bg-red-50 text-red-500 text-xs shrink-0">Emergência 24h</span>
                        </div>
                        <div class="flex items-center gap-1 mb-3">
                            <span class="star">★</span><span class="star">★</span><span
                                class="star">★</span><span class="star">★</span><span
                                class="text-slate-300">★</span>
                            <span class="text-xs text-slate-500 ml-1">4.7 (189 avaliações)</span>
                        </div>
                        <div class="space-y-1.5 text-sm text-slate-500 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-accent shrink-0"></i>
                                Rua Oscar Freire, 320 — Jardins
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-accent shrink-0"></i>
                                (11) 2345-6789
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-accent shrink-0"></i>
                                Aberto 24 horas
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-1 border border-accent text-accent text-xs font-semibold py-2 rounded-lg hover:bg-emerald-50 transition-colors">Ver
                                detalhes</button>
                            <button class="flex-1 btn-accent text-white text-xs font-semibold py-2 rounded-lg">Como
                                chegar</button>
                        </div>
                    </div>
                </div>

                <!-- Clínica 3 -->
                <div class="clinic-card bg-white rounded-2xl overflow-hidden shadow-sm">
                    <div class="h-36 bg-gradient-to-br from-amber-50 to-orange-100 flex items-center justify-center">
                        <i data-lucide="stethoscope" class="w-12 h-12 text-amber-500 opacity-40"></i>
                    </div>
                    <div class="p-5">
                        <div class="flex items-start justify-between gap-2 mb-2">
                            <h4 class="font-bold text-slate-800">Animal Health Clinic</h4>
                            <span class="pill-badge bg-emerald-50 text-accent text-xs shrink-0">Aberto</span>
                        </div>
                        <div class="flex items-center gap-1 mb-3">
                            <span class="star">★</span><span class="star">★</span><span
                                class="star">★</span><span class="star">★</span><span class="star">★</span>
                            <span class="text-xs text-slate-500 ml-1">5.0 (47 avaliações)</span>
                        </div>
                        <div class="space-y-1.5 text-sm text-slate-500 mb-4">
                            <div class="flex items-center gap-2">
                                <i data-lucide="map-pin" class="w-3.5 h-3.5 text-amber-500 shrink-0"></i>
                                Rua Vergueiro, 900 — Liberdade
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="phone" class="w-3.5 h-3.5 text-amber-500 shrink-0"></i>
                                (11) 4567-8901
                            </div>
                            <div class="flex items-center gap-2">
                                <i data-lucide="clock" class="w-3.5 h-3.5 text-amber-500 shrink-0"></i>
                                Seg–Dom 7h–22h
                            </div>
                        </div>
                        <div class="flex gap-2">
                            <button
                                class="flex-1 border border-amber-400 text-amber-600 text-xs font-semibold py-2 rounded-lg hover:bg-amber-50 transition-colors">Ver
                                detalhes</button>
                            <button
                                class="flex-1 bg-gradient-to-r from-amber-500 to-orange-500 text-white text-xs font-semibold py-2 rounded-lg shadow hover:shadow-md transition">Como
                                chegar</button>
                        </div>
                    </div>
                </div>

            </div><!-- /grid clínicas -->

            <!-- Ver mais -->
            <div class="text-center mt-10 reveal">
                <!-- TODO: Substituir pela URL real do sistema -->
                <a href="#"
                    class="inline-flex items-center gap-2 text-primary font-semibold hover:underline text-sm">
                    Ver todas as clínicas na sua região
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
            </div>

        </div>
    </section>
    <!-- /CLÍNICAS -->


    <!-- ═══════════════════════════════════════════════
       SEÇÃO DE CONFIANÇA (STATS + DEPOIMENTOS)
  ═══════════════════════════════════════════════ -->
    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Stats -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-20 reveal reveal-stagger">

                <div class="text-center p-6 rounded-2xl bg-primary-light">
                    <p class="stat-num text-4xl text-primary mb-1">+1.000</p>
                    <p class="text-sm text-slate-600 font-medium">Pets atendidos</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-emerald-50">
                    <p class="stat-num text-4xl text-accent mb-1">+200</p>
                    <p class="text-sm text-slate-600 font-medium">Veterinários verificados</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-amber-50">
                    <p class="stat-num text-4xl text-amber-600 mb-1">+50</p>
                    <p class="text-sm text-slate-600 font-medium">Cidades cobertas</p>
                </div>

                <div class="text-center p-6 rounded-2xl bg-rose-50">
                    <p class="stat-num text-4xl text-rose-500 mb-1">4.9★</p>
                    <p class="text-sm text-slate-600 font-medium">Avaliação média</p>
                </div>

            </div>

            <!-- Depoimentos -->
            <div class="text-center mb-12 reveal">
                <div class="pill-badge bg-slate-100 text-slate-600 mb-4 mx-auto w-fit">
                    <i data-lucide="quote" class="w-3.5 h-3.5"></i>
                    Depoimentos
                </div>
                <h2 class="font-display text-3xl font-extrabold text-slate-900">
                    O que dizem nossos usuários
                </h2>
            </div>

            <div class="grid md:grid-cols-3 gap-6 reveal reveal-stagger">

                <!-- Depoimento 1 -->
                <div class="testimonial-card bg-white border border-slate-100 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center gap-1 mb-4">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span
                            class="star">★</span><span class="star">★</span>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-5">
                        "Meu cachorro passou mal de madrugada e em minutos consegui falar com um veterinário pelo
                        VetTech. Me orientou perfeitamente e me salvou de uma viagem desnecessária de emergência."
                    </p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-primary-light flex items-center justify-center font-bold text-primary">
                            A</div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Ana Paula S.</p>
                            <p class="text-xs text-slate-400">Dona de dois labradores, São Paulo</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 2 -->
                <div class="testimonial-card bg-white border border-slate-100 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center gap-1 mb-4">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span
                            class="star">★</span><span class="star">★</span>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-5">
                        "Sou veterinária e uso o VetTech para ampliar meu atendimento. A plataforma é profissional,
                        segura e me conecta a tutores que realmente precisam de ajuda. Recomendo muito."
                    </p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center font-bold text-accent">
                            D</div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Dra. Daniela Moraes</p>
                            <p class="text-xs text-slate-400">Médica veterinária, CRMV-SP</p>
                        </div>
                    </div>
                </div>

                <!-- Depoimento 3 -->
                <div class="testimonial-card bg-white border border-slate-100 rounded-2xl p-6 shadow-md">
                    <div class="flex items-center gap-1 mb-4">
                        <span class="star">★</span><span class="star">★</span><span class="star">★</span><span
                            class="star">★</span><span class="star">★</span>
                    </div>
                    <p class="text-slate-600 text-sm leading-relaxed mb-5">
                        "Incrível a praticidade. Em menos de 3 minutos encontrei a clínica mais próxima de casa e
                        agendei a consulta. Minha gatinha está bem e eu fico mais tranquilo sabendo que tenho esse
                        suporte."
                    </p>
                    <div class="flex items-center gap-3">
                        <div
                            class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center font-bold text-amber-600">
                            M</div>
                        <div>
                            <p class="font-semibold text-slate-800 text-sm">Marcos Henrique L.</p>
                            <p class="text-xs text-slate-400">Tutor de gato e dois hamsters, Campinas</p>
                        </div>
                    </div>
                </div>

            </div><!-- /depoimentos -->
        </div>
    </section>
    <!-- /CONFIANÇA -->


    <!-- ═══════════════════════════════════════════════
       CTA FINAL
  ═══════════════════════════════════════════════ -->
    <section class="cta-bg py-24">
        <div class="max-w-3xl mx-auto px-5 text-center reveal">

            <!-- Ícone decorativo -->
            <div class="w-16 h-16 bg-white/20 rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i data-lucide="heart-pulse" class="w-8 h-8 text-white"></i>
            </div>

            <!-- Headline -->
            <h2 class="font-display text-4xl md:text-5xl font-extrabold text-white mb-5 leading-tight">
                Seu pet <br />não pode esperar.
            </h2>

            <p class="text-white/80 text-lg mb-10 max-w-xl mx-auto">
                Acesse agora o VetTech e garanta o cuidado que seu animal merece — onde você estiver, a qualquer hora.
            </p>

            <!-- Botões CTA -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center">

                <!-- TODO: Substituir pela URL real do sistema -->
                <a href="#clinicas"
                    class="bg-white text-primary font-bold px-8 py-4 rounded-full text-base flex items-center gap-2 justify-center shadow-xl hover:shadow-2xl hover:-translate-y-1 transition-all">
                    <i data-lucide="building-2" class="w-5 h-5"></i>
                    Buscar clínicas
                </a>

                <!-- TODO: Substituir pela URL real do sistema -->
                <a href="#telemedicina"
                    class="bg-white/15 border-2 border-white text-white font-bold px-8 py-4 rounded-full text-base flex items-center gap-2 justify-center hover:bg-white/25 hover:-translate-y-1 transition-all">
                    <i data-lucide="video" class="w-5 h-5"></i>
                    Atendimento online agora
                </a>

            </div><!-- /botões CTA -->

            <!-- Confiança extra -->
            <div class="flex flex-wrap justify-center gap-6 mt-10 text-white/70 text-sm">
                <div class="flex items-center gap-1.5">
                    <i data-lucide="shield-check" class="w-4 h-4"></i>
                    Profissionais verificados
                </div>
                <div class="flex items-center gap-1.5">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                    Dados protegidos (LGPD)
                </div>
                <div class="flex items-center gap-1.5">
                    <i data-lucide="clock" class="w-4 h-4"></i>
                    Disponível 24/7
                </div>
            </div>

        </div>
    </section>
    <!-- /CTA FINAL -->


    <!-- ═══════════════════════════════════════════════
       FOOTER
  ═══════════════════════════════════════════════ -->
    <footer id="contato" class="bg-slate-900 text-slate-400 py-16">
        <div class="max-w-7xl mx-auto px-5">

            <!-- Grid principal -->
            <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-10 mb-12">

                <!-- Coluna 1: Marca -->
                <div class="col-span-1 md:col-span-1">
                    <a href="#inicio" class="flex items-center gap-2 font-display text-xl font-bold text-white mb-4">
                        <span class="w-8 h-8 rounded-lg bg-primary flex items-center justify-center">
                            <i data-lucide="heart-pulse" class="w-4 h-4 text-white"></i>
                        </span>
                        VetTech
                    </a>
                    <p class="text-sm leading-relaxed mb-5">
                        A plataforma digital que une tecnologia e cuidado animal. Atendimento veterinário onde você
                        estiver.
                    </p>
                    <!-- Redes sociais -->
                    <div class="flex gap-3">
                        <a href="#"
                            class="w-9 h-9 rounded-full bg-slate-800 hover:bg-primary transition-colors flex items-center justify-center">
                            <i data-lucide="instagram" class="w-4 h-4 text-white"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 rounded-full bg-slate-800 hover:bg-primary transition-colors flex items-center justify-center">
                            <i data-lucide="facebook" class="w-4 h-4 text-white"></i>
                        </a>
                        <a href="#"
                            class="w-9 h-9 rounded-full bg-slate-800 hover:bg-primary transition-colors flex items-center justify-center">
                            <i data-lucide="twitter" class="w-4 h-4 text-white"></i>
                        </a>
                    </div>
                </div>

                <!-- Coluna 2: Plataforma -->
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4">Plataforma</h5>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="#como-funciona" class="hover:text-white transition-colors">Como funciona</a></li>
                        <li><a href="#clinicas" class="hover:text-white transition-colors">Clínicas cadastradas</a>
                        </li>
                        <li><a href="#telemedicina" class="hover:text-white transition-colors">Telemedicina</a></li>
                        <li><a href="#beneficios" class="hover:text-white transition-colors">Benefícios</a></li>
                    </ul>
                </div>

                <!-- Coluna 3: Para profissionais -->
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4">Para profissionais</h5>
                    <ul class="space-y-2.5 text-sm">
                        <!-- TODO: Substituir pela URL real do sistema -->
                        <li><a href="#" class="hover:text-white transition-colors">Cadastre sua clínica</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Seja um veterinário
                                parceiro</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Painel de gestão</a></li>
                        <li><a href="#" class="hover:text-white transition-colors">Suporte para clínicas</a>
                        </li>
                    </ul>
                </div>

                <!-- Coluna 4: Contato -->
                <div>
                    <h5 class="text-white font-semibold text-sm mb-4">Contato</h5>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-center gap-2">
                            <i data-lucide="mail" class="w-4 h-4 text-primary shrink-0"></i>
                            contato@vettech.com.br
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="phone" class="w-4 h-4 text-primary shrink-0"></i>
                            (11) 9 9999-0000
                        </li>
                        <li class="flex items-center gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-primary shrink-0"></i>
                            São Paulo, SP — Brasil
                        </li>
                    </ul>
                </div>

            </div><!-- /grid footer -->

            <!-- Linha divisória -->
            <div
                class="border-t border-slate-800 pt-8 flex flex-col md:flex-row items-center justify-between gap-4 text-sm">

                <p>© 2025 VetTech. Todos os direitos reservados.</p>

                <div class="flex gap-6">
                    <!-- TODO: Substituir pela URL real do sistema -->
                    <a href="#" class="hover:text-white transition-colors">Política de Privacidade</a>
                    <a href="#" class="hover:text-white transition-colors">Termos de Uso</a>
                    <a href="#" class="hover:text-white transition-colors">LGPD</a>
                </div>

            </div><!-- /bottom footer -->
        </div>
    </footer>
    <!-- /FOOTER -->


    <!-- ═══════════════════════════════════════════════
       SCRIPTS
  ═══════════════════════════════════════════════ -->
    <script>
        // ── 1. Inicializar ícones Lucide ──
        lucide.createIcons();

        // ── 2. Menu mobile hamburguer ──
        const hamburger = document.getElementById('hamburger');
        const mobileMenu = document.getElementById('mobile-menu');

        hamburger.addEventListener('click', () => {
            mobileMenu.classList.toggle('open');
        });

        // Fechar menu ao clicar em link mobile
        mobileMenu.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', () => mobileMenu.classList.remove('open'));
        });

        // ── 3. Animações de scroll com IntersectionObserver ──
        const reveals = document.querySelectorAll('.reveal');

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    // Ativar filhos com stagger
                    if (entry.target.classList.contains('reveal-stagger')) {
                        entry.target.querySelectorAll(':scope > *').forEach((child, i) => {
                            child.style.transitionDelay = `${i * 0.1}s`;
                            child.style.opacity = '0';
                            child.style.transform = 'translateY(24px)';
                            child.style.transition = 'opacity 0.55s ease, transform 0.55s ease';
                            // Ativar após um frame
                            requestAnimationFrame(() => {
                                setTimeout(() => {
                                    child.style.opacity = '1';
                                    child.style.transform = 'translateY(0)';
                                }, 50);
                            });
                        });
                    }
                    entry.target.classList.add('visible');
                    observer.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12,
            rootMargin: '0px 0px -40px 0px'
        });

        reveals.forEach(el => observer.observe(el));

        // ── 4. Navbar sombra ao rolar ──
        window.addEventListener('scroll', () => {
            const header = document.querySelector('header');
            if (window.scrollY > 20) {
                header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.08)';
            } else {
                header.style.boxShadow = 'none';
            }
        });
    </script>

</body>

</html>
