<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>VetTech — Login</title>

    <!-- ─── Tailwind CSS CDN ─── -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- ─── Lucide Icons CDN ─── -->
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

    <!-- ─── Google Fonts: DM Sans + Sora ─── -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Sora:wght@400;600;700;800&display=swap"
        rel="stylesheet" />

    <script>
        /* ─── Tailwind custom config ─── */
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        brand: {
                            DEFAULT: '#2563EB',
                            dark: '#1d4ed8',
                            light: '#eff6ff'
                        },
                        accent: {
                            DEFAULT: '#10B981',
                            dark: '#059669',
                            light: '#ecfdf5'
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
                                transform: 'translateY(24px)'
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
                        floatY: {
                            '0%,100%': {
                                transform: 'translateY(0)'
                            },
                            '50%': {
                                transform: 'translateY(-10px)'
                            }
                        },
                        pulseRing: {
                            '0%': {
                                boxShadow: '0 0 0 0 rgba(16,185,129,.45)'
                            },
                            '70%': {
                                boxShadow: '0 0 0 12px rgba(16,185,129,0)'
                            },
                            '100%': {
                                boxShadow: '0 0 0 0 rgba(16,185,129,0)'
                            }
                        },
                    },
                    animation: {
                        'fade-up': 'fadeUp .65s cubic-bezier(.22,1,.36,1) both',
                        'fade-in': 'fadeIn .55s ease both',
                        'float': 'floatY 3.5s ease-in-out infinite',
                        'pulse-ring': 'pulseRing 2.4s ease-in-out infinite',
                    },
                },
            },
        };
    </script>

    <style>
        /* ─── Base reset ─── */
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* ─── Custom scrollbar ─── */
        ::-webkit-scrollbar {
            width: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 99px;
        }

        /* ─── Background image with parallax-ready blur ─── */
        .bg-scene {
            background-image: url('https://images.unsplash.com/photo-1587300003388-59208cc962cb?auto=format&fit=crop&w=1920&q=80');
            background-size: cover;
            background-position: center;
        }

        /* ─── Glassmorphism card ─── */
        .glass-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.6);
        }

        /* ─── Animated gradient border on focus ─── */
        .input-field {
            transition: box-shadow .25s ease, border-color .25s ease;
        }

        .input-field:focus {
            outline: none;
            border-color: #2563EB;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        /* ─── Primary button shimmer ─── */
        .btn-primary {
            background: linear-gradient(135deg, #2563EB 0%, #1d4ed8 100%);
            transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(37, 99, 235, 0.45);
            background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
        }

        .btn-primary:active {
            transform: translateY(0);
        }

        /* ─── Side panel gradient overlay ─── */
        .side-overlay {
            background: linear-gradient(135deg,
                    rgba(37, 99, 235, 0.88) 0%,
                    rgba(16, 185, 129, 0.75) 100%);
        }

        /* ─── Stagger animation delays ─── */
        .delay-100 {
            animation-delay: .10s;
        }

        .delay-200 {
            animation-delay: .20s;
        }

        .delay-300 {
            animation-delay: .30s;
        }

        .delay-400 {
            animation-delay: .40s;
        }

        .delay-500 {
            animation-delay: .50s;
        }

        .delay-600 {
            animation-delay: .60s;
        }

        .delay-700 {
            animation-delay: .70s;
        }

        /* ─── Password visibility toggle ─── */
        .toggle-pw {
            cursor: pointer;
            user-select: none;
        }

        /* ─── Stat card shine ─── */
        .stat-card {
            background: rgba(255, 255, 255, .12);
            border: 1px solid rgba(255, 255, 255, .22);
            backdrop-filter: blur(8px);
        }

        /* ─── Custom checkbox ─── */
        input[type="checkbox"] {
            accent-color: #2563EB;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }
    </style>
</head>

<body class="min-h-screen antialiased text-slate-800">

    <!-- ═══════════════════════════════════════════════
       FULL-PAGE WRAPPER — two-column on desktop
  ═══════════════════════════════════════════════ -->
    <main class="min-h-screen flex">

        <!-- ───────────────────────────────────────────
         LEFT PANEL — hero image + brand story
         Hidden on mobile, visible lg+
    ─────────────────────────────────────────────── -->
        <section class="hidden lg:flex lg:w-[52%] xl:w-[58%] relative overflow-hidden bg-scene animate-fade-in">

            <!-- Dark-to-accent overlay -->
            <div class="absolute inset-0 side-overlay"></div>

            <!-- Subtle dot pattern -->
            <div class="absolute inset-0 opacity-10"
                style="background-image: radial-gradient(circle, rgba(255,255,255,.6) 1px, transparent 1px); background-size: 28px 28px;">
            </div>

            <!-- Content -->
            <div class="relative z-10 flex flex-col justify-between w-full p-12 xl:p-16">

                <!-- Logo (side panel) -->
                <a href="/" class="flex items-center gap-3 w-fit animate-fade-up">
                    <div
                        class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center border border-white/30">
                        <i data-lucide="heart-pulse" class="w-5 h-5 text-white"></i>
                    </div>
                    <span class="font-display text-2xl font-bold text-white tracking-tight">VetTech</span>
                </a>

                <!-- Hero text block -->
                <div class="space-y-6 animate-fade-up delay-200">
                    <!-- Badge -->
                    <span
                        class="inline-flex items-center gap-2 bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse-ring"></span>
                        Plataforma ativa 24/7
                    </span>

                    <!-- Headline -->
                    <h1 class="font-display text-4xl xl:text-5xl font-bold text-white leading-tight">
                        Cuidado veterinário<br />
                        <span class="text-accent drop-shadow-sm">rápido,</span> onde<br />
                        você estiver.
                    </h1>

                    <!-- Sub -->
                    <p class="text-white/75 text-base xl:text-lg leading-relaxed max-w-sm">
                        Conecte-se a clínicas, agende consultas e acesse telemedicina veterinária em minutos — tudo em
                        um só lugar.
                    </p>

                    <!-- Feature chips -->
                    <div class="flex flex-wrap gap-3 pt-2">
                        <span
                            class="feature-chip flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/90 text-sm px-3 py-1.5 rounded-lg">
                            <i data-lucide="video" class="w-3.5 h-3.5"></i> Telemedicina
                        </span>
                        <span
                            class="feature-chip flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/90 text-sm px-3 py-1.5 rounded-lg">
                            <i data-lucide="calendar-check" class="w-3.5 h-3.5"></i> Agendamento online
                        </span>
                        <span
                            class="feature-chip flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/90 text-sm px-3 py-1.5 rounded-lg">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5"></i> Clínicas próximas
                        </span>
                    </div>
                </div>

                <!-- Social proof stats -->
                <div class="grid grid-cols-3 gap-3 animate-fade-up delay-400">
                    <div class="stat-card rounded-2xl p-4 text-center">
                        <p class="font-display text-2xl font-bold text-white">+48k</p>
                        <p class="text-white/65 text-xs mt-0.5">Pets atendidos</p>
                    </div>
                    <div class="stat-card rounded-2xl p-4 text-center">
                        <p class="font-display text-2xl font-bold text-white">1.2k</p>
                        <p class="text-white/65 text-xs mt-0.5">Clínicas parceiras</p>
                    </div>
                    <div class="stat-card rounded-2xl p-4 text-center">
                        <p class="font-display text-2xl font-bold text-white">4.9★</p>
                        <p class="text-white/65 text-xs mt-0.5">Avaliação média</p>
                    </div>
                </div>

            </div><!-- /content -->

            <!-- Floating paw decoration (bottom-right) -->
            <div class="absolute bottom-8 right-8 animate-float opacity-20">
                <i data-lucide="paw-print" class="w-32 h-32 text-white"></i>
            </div>

        </section>
        <!-- /left panel -->


        <!-- ───────────────────────────────────────────
         RIGHT PANEL — login card
    ─────────────────────────────────────────────── -->
        <section
            class="flex-1 flex items-center justify-center bg-slate-50 px-5 py-10 sm:px-10 relative overflow-hidden">

            <!-- Subtle background decoration -->
            <div class="absolute -top-32 -right-32 w-80 h-80 rounded-full bg-brand/5 blur-3xl pointer-events-none">
            </div>
            <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-accent/5 blur-3xl pointer-events-none">
            </div>

            <!-- ── Card wrapper ── -->
            <div
                class="glass-card w-full max-w-md rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.10)] p-8 sm:p-10 animate-fade-up">

                <!-- ── Logo (card top, shown always) ── -->
                <div class="flex flex-col items-center mb-8 animate-fade-up delay-100">
                    <!-- Logo mark -->
                    <div
                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-brand to-accent flex items-center justify-center shadow-lg mb-4">
                        <i data-lucide="heart-pulse" class="w-7 h-7 text-white"></i>
                    </div>
                    <!-- Word mark -->
                    <h2 class="font-display text-2xl font-bold text-slate-900 tracking-tight">VetTech</h2>
                    <p class="text-slate-500 text-sm mt-1">Saúde animal conectada</p>
                </div>

                <!-- ── Greeting ── -->
                <div class="mb-7 animate-fade-up delay-200">
                    <h3 class="font-display text-xl font-bold text-slate-900">Bem-vindo de volta 👋</h3>
                    <p class="text-slate-500 text-sm mt-1">Entre para continuar cuidando do seu pet.</p>
                </div>

                <!-- ══════════════════════════════════════
             LOGIN FORM
        ══════════════════════════════════════ -->
                <form id="loginForm" novalidate class="space-y-5">

                    <!-- Email field -->
                    <div class="animate-fade-up delay-300">
                        <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            E-mail
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                            </span>
                            <input id="email" type="email" autocomplete="email" placeholder="seu@email.com"
                                class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
                        </div>
                        <!-- Inline error (hidden by default) -->
                        <p id="emailErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> Informe um e-mail válido.
                        </p>
                    </div>

                    <!-- Password field -->
                    <div class="animate-fade-up delay-400">
                        <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">
                            Senha
                        </label>
                        <div class="relative">
                            <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                                <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                            </span>
                            <input id="password" type="password" autocomplete="current-password" placeholder="••••••••"
                                class="input-field w-full pl-10 pr-11 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
                            <!-- Toggle visibility -->
                            <button type="button" id="togglePw"
                                class="toggle-pw absolute inset-y-0 right-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors"
                                aria-label="Mostrar/ocultar senha">
                                <i data-lucide="eye" id="eyeIcon" class="w-4 h-4"></i>
                            </button>
                        </div>
                        <p id="passwordErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                            <i data-lucide="alert-circle" class="w-3 h-3"></i> Informe sua senha.
                        </p>
                    </div>

                    <!-- Remember me + Forgot password -->
                    <div class="flex items-center justify-between animate-fade-up delay-500">
                        <label class="flex items-center gap-2 cursor-pointer select-none">
                            <input type="checkbox" id="remember" class="rounded" />
                            <span class="text-sm text-slate-600">Lembrar de mim</span>
                        </label>
                        <a href="#"
                            class="text-sm font-semibold text-brand hover:text-brand-dark transition-colors hover:underline underline-offset-2">
                            Esqueci minha senha
                        </a>
                    </div>

                    <!-- Submit button -->
                    <div class="pt-1 animate-fade-up delay-600">
                        <button type="submit" id="submitBtn"
                            class="btn-primary w-full py-3.5 rounded-xl text-white font-semibold text-base flex items-center justify-center gap-2 shadow-md">
                            <span id="btnText">Entrar</span>
                            <i data-lucide="arrow-right" class="w-4 h-4" id="btnIcon"></i>
                            <!-- Loader (hidden) -->
                            <svg id="btnLoader" class="hidden animate-spin w-5 h-5 text-white"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                    stroke="currentColor" stroke-width="4"></circle>
                                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                            </svg>
                        </button>
                    </div>

                </form>
                <!-- /form -->

                <!-- ── Divider ── -->
                <div class="relative my-7 animate-fade-up delay-700">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-slate-200"></div>
                    </div>
                    <div class="relative flex justify-center">
                        <span class="bg-white px-3 text-xs text-slate-400 font-medium">ou continue com</span>
                    </div>
                </div>

                <!-- ── Social logins ── -->
                <div class="grid grid-cols-2 gap-3 animate-fade-up delay-700">
                    <!-- Google -->
                    <button type="button"
                        class="flex items-center justify-center gap-2 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm hover:shadow">
                        <!-- Google SVG inline (no external dependency) -->
                        <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"
                                fill="#4285F4" />
                            <path
                                d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"
                                fill="#34A853" />
                            <path
                                d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"
                                fill="#FBBC05" />
                            <path
                                d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"
                                fill="#EA4335" />
                        </svg>
                        Google
                    </button>
                    <!-- Apple -->
                    <button type="button"
                        class="flex items-center justify-center gap-2 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all duration-200 shadow-sm hover:shadow">
                        <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.9-1.99 1.57-2.987 1.57-.12 0-.23-.02-.3-.03-.01-.06-.04-.22-.04-.39 0-1.15.572-2.27 1.206-2.98.804-.94 2.142-1.64 3.248-1.68.03.13.05.28.05.43zm4.565 15.71c-.03.07-.463 1.58-1.518 3.12-.945 1.34-1.94 2.71-3.43 2.71-1.517 0-1.9-.88-3.63-.88-1.698 0-2.302.91-3.67.91-1.377 0-2.332-1.26-3.428-2.8-1.287-1.82-2.323-4.63-2.323-7.28 0-3.55 2.33-5.43 4.62-5.43 1.42 0 2.756.93 3.71.93.872 0 2.43-1.04 4.155-.89.7.03 2.677.28 3.95 2.08l-.048.03z" />
                        </svg>
                        Apple
                    </button>
                </div>

                <!-- ── Sign-up link ── -->
                <p class="text-center text-sm text-slate-500 mt-7 animate-fade-up delay-700">
                    Não possui conta?
                    <a href="#"
                        class="font-semibold text-brand hover:text-brand-dark transition-colors hover:underline underline-offset-2">
                        Criar conta grátis
                    </a>
                </p>

                <!-- ── Back to home ── -->
                <div class="flex justify-center mt-4 animate-fade-up delay-700">
                    <a href="/"
                        class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-slate-600 transition-colors group">
                        <i data-lucide="arrow-left"
                            class="w-3 h-3 group-hover:-translate-x-0.5 transition-transform"></i>
                        Voltar à página inicial
                    </a>
                </div>

            </div>
            <!-- /card -->

        </section>
        <!-- /right panel -->

    </main>


    <!-- ═══════════════════════════════════════════════
        JAVASCRIPT — interactions
    ═══════════════════════════════════════════════ -->
    <script>
        /* ─── Init Lucide icons ─── */
        lucide.createIcons();

        /* ─────────────────────────────────────
            Password toggle
        ───────────────────────────────────── */
        const togglePw = document.getElementById('togglePw');
        const passwordEl = document.getElementById('password');
        const eyeIcon = document.getElementById('eyeIcon');
        let pwVisible = false;

        togglePw.addEventListener('click', () => {
            pwVisible = !pwVisible;
            passwordEl.type = pwVisible ? 'text' : 'password';
            eyeIcon.setAttribute('data-lucide', pwVisible ? 'eye-off' : 'eye');
            lucide.createIcons(); // re-render new icon
        });

        /* ─────────────────────────────────────
            Form submit with basic validation
        ───────────────────────────────────── */
        const form = document.getElementById('loginForm');
        const emailEl = document.getElementById('email');
        const emailErr = document.getElementById('emailErr');
        const passwordErr = document.getElementById('passwordErr');
        const submitBtn = document.getElementById('submitBtn');
        const btnText = document.getElementById('btnText');
        const btnIcon = document.getElementById('btnIcon');
        const btnLoader = document.getElementById('btnLoader');

        function validateEmail(v) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v);
        }

        form.addEventListener('submit', async (e) => {
            e.preventDefault();
            let valid = true;

            /* Email validation */
            if (!validateEmail(emailEl.value.trim())) {
                emailErr.classList.remove('hidden');
                emailEl.classList.add('border-red-400');
                valid = false;
            } else {
                emailErr.classList.add('hidden');
                emailEl.classList.remove('border-red-400');
            }

            /* Password validation */
            if (passwordEl.value.length < 1) {
                passwordErr.classList.remove('hidden');
                passwordEl.classList.add('border-red-400');
                valid = false;
            } else {
                passwordErr.classList.add('hidden');
                passwordEl.classList.remove('border-red-400');
            }

            if (!valid) return;

            /* Simulate async login request */
            submitBtn.disabled = true;
            btnText.textContent = 'Entrando…';
            btnIcon.classList.add('hidden');
            btnLoader.classList.remove('hidden');

            await new Promise(r => setTimeout(r, 1800)); // simulated delay

            /* Reset (in production, redirect here) */
            btnText.textContent = 'Entrar';
            btnIcon.classList.remove('hidden');
            btnLoader.classList.add('hidden');
            submitBtn.disabled = false;

            /* Demo success feedback */
            submitBtn.classList.replace('btn-primary', 'bg-accent');
            submitBtn.classList.add('cursor-default');
            btnText.textContent = '✓ Sucesso!';
            setTimeout(() => {
                submitBtn.classList.replace('bg-accent', 'btn-primary');
                submitBtn.classList.remove('cursor-default');
                btnText.textContent = 'Entrar';
            }, 2200);
        });

        /* ─────────────────────────────────────
            Clear errors on input
        ───────────────────────────────────── */
        emailEl.addEventListener('input', () => {
            emailErr.classList.add('hidden');
            emailEl.classList.remove('border-red-400');
        });
        passwordEl.addEventListener('input', () => {
            passwordErr.classList.add('hidden');
            passwordEl.classList.remove('border-red-400');
        });
    </script>

</body>

</html>
