<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>VetTech — Criar Conta</title>

  <!-- ─── Tailwind CSS CDN ─── -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- ─── Lucide Icons CDN ─── -->
  <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>

  <!-- ─── Google Fonts: DM Sans + Sora ─── -->
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Sora:wght@400;600;700;800&display=swap" rel="stylesheet" />

  <script>
    /* ─── Tailwind custom config — mirrors login page exactly ─── */
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            brand:  { DEFAULT: '#2563EB', dark: '#1d4ed8', light: '#eff6ff' },
            accent: { DEFAULT: '#10B981', dark: '#059669', light: '#ecfdf5' },
          },
          fontFamily: {
            sans:    ['DM Sans', 'sans-serif'],
            display: ['Sora', 'sans-serif'],
          },
          keyframes: {
            fadeUp:    { from: { opacity: '0', transform: 'translateY(22px)' }, to: { opacity: '1', transform: 'translateY(0)' } },
            fadeIn:    { from: { opacity: '0' }, to: { opacity: '1' } },
            floatY:    { '0%,100%': { transform: 'translateY(0)' }, '50%': { transform: 'translateY(-10px)' } },
            pulseRing: { '0%': { boxShadow: '0 0 0 0 rgba(16,185,129,.45)' }, '70%': { boxShadow: '0 0 0 12px rgba(16,185,129,0)' }, '100%': { boxShadow: '0 0 0 0 rgba(16,185,129,0)' } },
            scaleIn:   { from: { opacity: '0', transform: 'scale(.96)' }, to: { opacity: '1', transform: 'scale(1)' } },
          },
          animation: {
            'fade-up':    'fadeUp .65s cubic-bezier(.22,1,.36,1) both',
            'fade-in':    'fadeIn .55s ease both',
            'float':      'floatY 3.5s ease-in-out infinite',
            'pulse-ring': 'pulseRing 2.4s ease-in-out infinite',
            'scale-in':   'scaleIn .5s cubic-bezier(.22,1,.36,1) both',
          },
        },
      },
    };
  </script>

  <style>
    /* ─── Base ─── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
    html { scroll-behavior: smooth; }
    body { font-family: 'DM Sans', sans-serif; }

    /* ─── Scrollbar ─── */
    ::-webkit-scrollbar { width: 6px; }
    ::-webkit-scrollbar-track { background: transparent; }
    ::-webkit-scrollbar-thumb { background: #cbd5e1; border-radius: 99px; }

    /* ─── Background hero image ─── */
    .bg-scene {
      background-image: url('https://images.unsplash.com/photo-1548199973-03cce0bbc87b?auto=format&fit=crop&w=1920&q=80');
      background-size: cover;
      background-position: center 30%;
    }

    /* ─── Side panel gradient — same spec as login ─── */
    .side-overlay {
      background: linear-gradient(135deg,
        rgba(37,99,235,.88) 0%,
        rgba(16,185,129,.75) 100%);
    }

    /* ─── Glassmorphism card ─── */
    .glass-card {
      background: rgba(255,255,255,.97);
      backdrop-filter: blur(20px) saturate(180%);
      -webkit-backdrop-filter: blur(20px) saturate(180%);
      border: 1px solid rgba(255,255,255,.6);
    }

    /* ─── Input focus ring ─── */
    .input-field {
      transition: box-shadow .22s ease, border-color .22s ease;
    }
    .input-field:focus {
      outline: none;
      border-color: #2563EB;
      box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    }
    .input-field.error {
      border-color: #f87171;
    }
    .input-field.error:focus {
      box-shadow: 0 0 0 3px rgba(248,113,113,.18);
    }

    /* ─── Primary CTA button ─── */
    .btn-primary {
      background: linear-gradient(135deg, #2563EB 0%, #1d4ed8 100%);
      transition: transform .2s ease, box-shadow .2s ease, background .2s ease;
    }
    .btn-primary:hover {
      transform: translateY(-2px);
      box-shadow: 0 8px 24px rgba(37,99,235,.42);
      background: linear-gradient(135deg, #1d4ed8 0%, #1e40af 100%);
    }
    .btn-primary:active { transform: translateY(0); }
    .btn-primary:disabled { opacity: .65; cursor: not-allowed; transform: none; box-shadow: none; }

    /* ─── User-type selection cards ─── */
    .type-card {
      border: 2px solid #e2e8f0;
      transition: border-color .2s, background .2s, box-shadow .2s, transform .18s;
      cursor: pointer;
    }
    .type-card:hover {
      border-color: #93c5fd;
      background: #eff6ff;
      transform: translateY(-2px);
      box-shadow: 0 6px 18px rgba(37,99,235,.12);
    }
    .type-card.selected {
      border-color: #2563EB;
      background: #eff6ff;
      box-shadow: 0 0 0 3px rgba(37,99,235,.15);
    }
    .type-card.selected .type-icon {
      background: linear-gradient(135deg, #2563EB, #10B981);
      color: #fff;
    }
    .type-icon {
      background: #f1f5f9;
      color: #64748b;
      transition: background .2s, color .2s;
    }

    /* ─── Password strength bar ─── */
    .strength-bar { transition: width .35s ease, background .35s ease; }

    /* ─── Stat card (side panel) ─── */
    .stat-card {
      background: rgba(255,255,255,.12);
      border: 1px solid rgba(255,255,255,.22);
      backdrop-filter: blur(8px);
    }

    /* ─── Dot pattern overlay ─── */
    .dot-pattern {
      background-image: radial-gradient(circle, rgba(255,255,255,.55) 1px, transparent 1px);
      background-size: 28px 28px;
    }

    /* ─── Checkbox custom ─── */
    input[type="checkbox"] { accent-color: #2563EB; width: 16px; height: 16px; cursor: pointer; }

    /* ─── Stagger delays ─── */
    .delay-100 { animation-delay: .10s; }
    .delay-150 { animation-delay: .15s; }
    .delay-200 { animation-delay: .20s; }
    .delay-250 { animation-delay: .25s; }
    .delay-300 { animation-delay: .30s; }
    .delay-350 { animation-delay: .35s; }
    .delay-400 { animation-delay: .40s; }
    .delay-450 { animation-delay: .45s; }
    .delay-500 { animation-delay: .50s; }
    .delay-550 { animation-delay: .55s; }
    .delay-600 { animation-delay: .60s; }
    .delay-700 { animation-delay: .70s; }
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
    <section class="hidden lg:flex lg:w-[46%] xl:w-[52%] relative overflow-hidden bg-scene animate-fade-in flex-shrink-0">

      <!-- Gradient overlay -->
      <div class="absolute inset-0 side-overlay"></div>

      <!-- Dot pattern -->
      <div class="absolute inset-0 opacity-10 dot-pattern"></div>

      <!-- Panel content -->
      <div class="relative z-10 flex flex-col justify-between w-full p-12 xl:p-14">

        <!-- Logo -->
        <a href="/" class="flex items-center gap-3 w-fit animate-fade-up">
          <div class="w-10 h-10 rounded-xl bg-white/20 flex items-center justify-center border border-white/30">
            <i data-lucide="heart-pulse" class="w-5 h-5 text-white"></i>
          </div>
          <span class="font-display text-2xl font-bold text-white tracking-tight">VetTech</span>
        </a>

        <!-- Hero text -->
        <div class="space-y-6 animate-fade-up delay-200">
          <!-- Active badge -->
          <span class="inline-flex items-center gap-2 bg-white/15 border border-white/25 text-white text-xs font-semibold px-3 py-1.5 rounded-full backdrop-blur-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-accent animate-pulse-ring"></span>
            Cadastro gratuito e rápido
          </span>

          <!-- Headline -->
          <h1 class="font-display text-4xl xl:text-[2.65rem] font-bold text-white leading-tight">
            Tecnologia e cuidado<br/>
            para quem<br/>
            <span class="text-accent drop-shadow-sm">ama pets.</span>
          </h1>

          <!-- Description -->
          <p class="text-white/75 text-base xl:text-lg leading-relaxed max-w-sm">
            Conecte-se a clínicas veterinárias e profissionais online de forma rápida e segura.
          </p>

          <!-- Feature chips -->
          <div class="flex flex-wrap gap-3 pt-1">
            <span class="flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/90 text-sm px-3 py-1.5 rounded-lg">
              <i data-lucide="shield-check" class="w-3.5 h-3.5"></i> Dados protegidos
            </span>
            <span class="flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/90 text-sm px-3 py-1.5 rounded-lg">
              <i data-lucide="zap" class="w-3.5 h-3.5"></i> Acesso imediato
            </span>
            <span class="flex items-center gap-1.5 bg-white/10 border border-white/20 text-white/90 text-sm px-3 py-1.5 rounded-lg">
              <i data-lucide="users" class="w-3.5 h-3.5"></i> Comunidade ativa
            </span>
          </div>
        </div>

        <!-- Stats -->
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

      </div>

      <!-- Floating paw decoration -->
      <div class="absolute bottom-8 right-8 animate-float opacity-20">
        <i data-lucide="paw-print" class="w-28 h-28 text-white"></i>
      </div>

    </section>
    <!-- /left panel -->


    <!-- ───────────────────────────────────────────
         RIGHT PANEL — registration card
    ─────────────────────────────────────────────── -->
    <section class="flex-1 flex items-start justify-center bg-slate-50 px-5 py-8 sm:px-10 relative overflow-hidden min-h-screen">

      <!-- Background blobs -->
      <div class="absolute -top-32 -right-32 w-80 h-80 rounded-full bg-brand/5 blur-3xl pointer-events-none"></div>
      <div class="absolute -bottom-32 -left-32 w-80 h-80 rounded-full bg-accent/5 blur-3xl pointer-events-none"></div>

      <!-- ── Card ── -->
      <div class="glass-card w-full max-w-lg rounded-3xl shadow-[0_8px_40px_rgba(0,0,0,0.10)] p-8 sm:p-10 my-4 animate-fade-up">

        <!-- ── Logo (always visible) ── -->
        <div class="flex flex-col items-center mb-6 animate-fade-up delay-100">
          <div class="w-13 h-13 w-14 h-14 rounded-2xl bg-gradient-to-br from-brand to-accent flex items-center justify-center shadow-lg mb-3">
            <i data-lucide="heart-pulse" class="w-7 h-7 text-white"></i>
          </div>
          <h2 class="font-display text-2xl font-bold text-slate-900 tracking-tight">VetTech</h2>
          <p class="text-slate-500 text-sm mt-0.5">Saúde animal conectada</p>
        </div>

        <!-- ── Greeting ── -->
        <div class="mb-6 animate-fade-up delay-150">
          <h3 class="font-display text-xl font-bold text-slate-900">Crie sua conta grátis 🐾</h3>
          <p class="text-slate-500 text-sm mt-1">Leva menos de 2 minutos. Sem cartão de crédito.</p>
        </div>

        <!-- ══════════════════════════════════════
             REGISTRATION FORM
        ══════════════════════════════════════ -->
        <form id="registerForm" novalidate class="space-y-5">

          <!-- ── SECTION: User type selection ── -->
          <div class="animate-fade-up delay-200">
            <p class="text-sm font-semibold text-slate-700 mb-3">Você é…</p>
            <div class="grid grid-cols-3 gap-2.5" role="radiogroup" aria-label="Tipo de usuário">

              <!-- Tutor -->
              <button type="button" data-type="tutor"
                class="type-card selected rounded-2xl p-3.5 flex flex-col items-center gap-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand"
                aria-pressed="true">
                <div class="type-icon w-10 h-10 rounded-xl flex items-center justify-center">
                  <i data-lucide="heart" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-semibold text-slate-700 text-center leading-tight">Tutor de Pet</span>
              </button>

              <!-- Veterinário -->
              <button type="button" data-type="vet"
                class="type-card rounded-2xl p-3.5 flex flex-col items-center gap-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand"
                aria-pressed="false">
                <div class="type-icon w-10 h-10 rounded-xl flex items-center justify-center">
                  <i data-lucide="stethoscope" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-semibold text-slate-700 text-center leading-tight">Méd. Veterinário</span>
              </button>

              <!-- Clínica -->
              <button type="button" data-type="clinic"
                class="type-card rounded-2xl p-3.5 flex flex-col items-center gap-2 focus:outline-none focus-visible:ring-2 focus-visible:ring-brand"
                aria-pressed="false">
                <div class="type-icon w-10 h-10 rounded-xl flex items-center justify-center">
                  <i data-lucide="building-2" class="w-5 h-5"></i>
                </div>
                <span class="text-xs font-semibold text-slate-700 text-center leading-tight">Clínica Veterinária</span>
              </button>

            </div>
            <!-- Hidden input to track selected type -->
            <input type="hidden" id="userType" value="tutor" />
          </div>

          <!-- ── SECTION: Two-column name + phone ── -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 animate-fade-up delay-250">

            <!-- Nome completo -->
            <div class="sm:col-span-2">
              <label for="fullName" class="block text-sm font-semibold text-slate-700 mb-1.5">Nome completo</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="user" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="fullName" type="text" autocomplete="name" placeholder="Seu nome completo"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
              </div>
              <p id="nameErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> Informe seu nome completo.
              </p>
            </div>

            <!-- Email -->
            <div>
              <label for="email" class="block text-sm font-semibold text-slate-700 mb-1.5">E-mail</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="mail" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="email" type="email" autocomplete="email" placeholder="seu@email.com"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
              </div>
              <p id="emailErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> E-mail inválido.
              </p>
            </div>

            <!-- Telefone -->
            <div>
              <label for="phone" class="block text-sm font-semibold text-slate-700 mb-1.5">Telefone</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="phone" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="phone" type="tel" autocomplete="tel" placeholder="(11) 9 0000-0000"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
              </div>
              <p id="phoneErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> Telefone inválido.
              </p>
            </div>

            <!-- CPF -->
            <div class="sm:col-span-2">
              <label for="cpf" class="block text-sm font-semibold text-slate-700 mb-1.5">CPF</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="id-card" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="cpf" type="text" inputmode="numeric" autocomplete="off" placeholder="000.000.000-00"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" maxlength="14" />
              </div>
              <p id="cpfErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> CPF inválido.
              </p>
            </div>

          </div>

          <!-- ── SECTION: Endereço ── -->
          <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 animate-fade-up delay-300">

            <!-- CEP -->
            <div class="sm:col-span-1">
              <label for="cep" class="block text-sm font-semibold text-slate-700 mb-1.5">CEP</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="map-pin" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="cep" type="text" inputmode="numeric" autocomplete="postal-code" placeholder="00000-000"
                  class="input-field w-full pl-10 pr-10 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" maxlength="9" />
                <!-- Spinner para busca de CEP -->
                <span id="cepLoader" class="hidden absolute inset-y-0 right-3.5 flex items-center pointer-events-none">
                  <svg class="animate-spin w-4 h-4 text-brand" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
                  </svg>
                </span>
              </div>
              <p id="cepErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> CEP inválido ou não encontrado.
              </p>
            </div>

            <!-- Logradouro -->
            <div class="sm:col-span-2">
              <label for="street" class="block text-sm font-semibold text-slate-700 mb-1.5">Logradouro</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="home" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="street" type="text" autocomplete="street-address" placeholder="Rua, Avenida…"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
              </div>
              <p id="streetErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> Informe o logradouro.
              </p>
            </div>

            <!-- Número -->
            <div>
              <label for="number" class="block text-sm font-semibold text-slate-700 mb-1.5">Número</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="hash" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="number" type="text" inputmode="numeric" placeholder="123"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
              </div>
              <p id="numberErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> Informe o número.
              </p>
            </div>

            <!-- Bairro -->
            <div>
              <label for="neighborhood" class="block text-sm font-semibold text-slate-700 mb-1.5">Bairro</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="landmark" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="neighborhood" type="text" autocomplete="address-level3" placeholder="Bairro"
                  class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
              </div>
            </div>

            <!-- Cidade + UF -->
            <div class="flex gap-2">
              <div class="flex-1">
                <label for="city" class="block text-sm font-semibold text-slate-700 mb-1.5">Cidade</label>
                <div class="relative">
                  <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                    <i data-lucide="building" class="w-4 h-4 text-slate-400"></i>
                  </span>
                  <input id="city" type="text" autocomplete="address-level2" placeholder="Cidade"
                    class="input-field w-full pl-10 pr-4 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
                </div>
              </div>
              <div class="w-20">
                <label for="uf" class="block text-sm font-semibold text-slate-700 mb-1.5">UF</label>
                <input id="uf" type="text" autocomplete="address-level1" placeholder="SP" maxlength="2"
                  class="input-field w-full px-3 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400 uppercase text-center" />
              </div>
            </div>

          </div>

          <!-- ── SECTION: Passwords ── -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 animate-fade-up delay-350">

            <!-- Senha -->
            <div>
              <label for="password" class="block text-sm font-semibold text-slate-700 mb-1.5">Senha</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="lock" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="password" type="password" autocomplete="new-password" placeholder="Mín. 8 caracteres"
                  class="input-field w-full pl-10 pr-11 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
                <button type="button" id="togglePw1"
                  class="absolute inset-y-0 right-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors" aria-label="Mostrar senha">
                  <i data-lucide="eye" id="eyeIcon1" class="w-4 h-4"></i>
                </button>
              </div>
              <!-- Password strength bar -->
              <div class="mt-2 space-y-1" id="strengthWrap">
                <div class="h-1.5 w-full bg-slate-100 rounded-full overflow-hidden">
                  <div id="strengthBar" class="strength-bar h-full w-0 rounded-full bg-slate-300"></div>
                </div>
                <p id="strengthLabel" class="text-xs text-slate-400">Digite uma senha segura</p>
              </div>
              <p id="passwordErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> Mínimo de 8 caracteres.
              </p>
            </div>

            <!-- Confirmar senha -->
            <div>
              <label for="confirmPassword" class="block text-sm font-semibold text-slate-700 mb-1.5">Confirmar senha</label>
              <div class="relative">
                <span class="absolute inset-y-0 left-3.5 flex items-center pointer-events-none">
                  <i data-lucide="lock-keyhole" class="w-4 h-4 text-slate-400"></i>
                </span>
                <input id="confirmPassword" type="password" autocomplete="new-password" placeholder="Repita a senha"
                  class="input-field w-full pl-10 pr-11 py-3 rounded-xl border border-slate-200 bg-white text-slate-800 text-sm placeholder-slate-400" />
                <button type="button" id="togglePw2"
                  class="absolute inset-y-0 right-3.5 flex items-center text-slate-400 hover:text-slate-600 transition-colors" aria-label="Mostrar confirmação">
                  <i data-lucide="eye" id="eyeIcon2" class="w-4 h-4"></i>
                </button>
              </div>
              <p id="confirmErr" class="hidden text-xs text-red-500 mt-1 flex items-center gap-1">
                <i data-lucide="alert-circle" class="w-3 h-3"></i> As senhas não coincidem.
              </p>
            </div>

          </div>

          <!-- ── SECTION: Terms checkbox ── -->
          <div class="animate-fade-up delay-450">
            <label class="flex items-start gap-3 cursor-pointer select-none group">
              <input type="checkbox" id="terms" class="mt-0.5 rounded flex-shrink-0" />
              <span class="text-sm text-slate-600 leading-snug group-hover:text-slate-800 transition-colors">
                Li e concordo com os
                <a href="#" class="font-semibold text-brand hover:underline underline-offset-2">Termos de Uso</a>
                e a
                <a href="#" class="font-semibold text-brand hover:underline underline-offset-2">Política de Privacidade</a>
                do VetTech.
              </span>
            </label>
            <p id="termsErr" class="hidden text-xs text-red-500 mt-1.5 flex items-center gap-1">
              <i data-lucide="alert-circle" class="w-3 h-3"></i> Você precisa aceitar os termos para continuar.
            </p>
          </div>

          <!-- ── Submit button ── -->
          <div class="pt-1 animate-fade-up delay-500">
            <button type="submit" id="submitBtn"
              class="btn-primary w-full py-3.5 rounded-xl text-white font-semibold text-base flex items-center justify-center gap-2 shadow-md">
              <span id="btnText">Criar Conta</span>
              <i data-lucide="arrow-right" class="w-4 h-4" id="btnIcon"></i>
              <svg id="btnLoader" class="hidden animate-spin w-5 h-5 text-white" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8v8H4z"></path>
              </svg>
            </button>
          </div>

          <!-- ── Trust badges ── -->
          <div class="flex items-center justify-center gap-4 pt-1 animate-fade-up delay-550">
            <span class="flex items-center gap-1 text-xs text-slate-400">
              <i data-lucide="shield" class="w-3.5 h-3.5 text-accent"></i> SSL seguro
            </span>
            <span class="w-px h-3 bg-slate-200"></span>
            <span class="flex items-center gap-1 text-xs text-slate-400">
              <i data-lucide="lock" class="w-3.5 h-3.5 text-accent"></i> Dados criptografados
            </span>
            <span class="w-px h-3 bg-slate-200"></span>
            <span class="flex items-center gap-1 text-xs text-slate-400">
              <i data-lucide="ban" class="w-3.5 h-3.5 text-accent"></i> Sem spam
            </span>
          </div>

        </form>
        <!-- /form -->

        <!-- ── Divider ── -->
        <div class="relative my-6 animate-fade-up delay-600">
          <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-slate-200"></div>
          </div>
          <div class="relative flex justify-center">
            <span class="bg-white px-3 text-xs text-slate-400 font-medium">ou cadastre-se com</span>
          </div>
        </div>

        <!-- ── Social sign-up ── -->
        <div class="grid grid-cols-2 gap-3 animate-fade-up delay-600">
          <button type="button"
            class="flex items-center justify-center gap-2 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm hover:shadow">
            <svg class="w-4 h-4" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
              <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
              <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
              <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
              <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            Google
          </button>
          <button type="button"
            class="flex items-center justify-center gap-2 py-2.5 rounded-xl border border-slate-200 bg-white text-slate-700 text-sm font-medium hover:bg-slate-50 hover:border-slate-300 transition-all shadow-sm hover:shadow">
            <svg class="w-4 h-4" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
              <path d="M16.365 1.43c0 1.14-.493 2.27-1.177 3.08-.744.9-1.99 1.57-2.987 1.57-.12 0-.23-.02-.3-.03-.01-.06-.04-.22-.04-.39 0-1.15.572-2.27 1.206-2.98.804-.94 2.142-1.64 3.248-1.68.03.13.05.28.05.43zm4.565 15.71c-.03.07-.463 1.58-1.518 3.12-.945 1.34-1.94 2.71-3.43 2.71-1.517 0-1.9-.88-3.63-.88-1.698 0-2.302.91-3.67.91-1.377 0-2.332-1.26-3.428-2.8-1.287-1.82-2.323-4.63-2.323-7.28 0-3.55 2.33-5.43 4.62-5.43 1.42 0 2.756.93 3.71.93.872 0 2.43-1.04 4.155-.89.7.03 2.677.28 3.95 2.08l-.048.03z"/>
            </svg>
            Apple
          </button>
        </div>

        <!-- ── Login link ── -->
        <p class="text-center text-sm text-slate-500 mt-6 animate-fade-up delay-700">
          Já possui conta?
          <a href="vettech-login.html" class="font-semibold text-brand hover:text-brand-dark transition-colors hover:underline underline-offset-2">
            Entrar
          </a>
        </p>

        <!-- ── Back to home ── -->
        <div class="flex justify-center mt-3 animate-fade-up delay-700">
          <a href="/" class="inline-flex items-center gap-1.5 text-xs text-slate-400 hover:text-slate-600 transition-colors group">
            <i data-lucide="arrow-left" class="w-3 h-3 group-hover:-translate-x-0.5 transition-transform"></i>
            Voltar à página inicial
          </a>
        </div>

      </div>
      <!-- /card -->

    </section>
    <!-- /right panel -->

  </main>


  <!-- ═══════════════════════════════════════════════
       SUCCESS TOAST — appears after submit
  ═══════════════════════════════════════════════ -->
  <div id="successToast"
    class="fixed bottom-6 right-6 z-50 hidden items-center gap-3 bg-white border border-slate-100 shadow-xl rounded-2xl px-5 py-4 max-w-xs animate-scale-in">
    <div class="w-9 h-9 rounded-xl bg-accent/10 flex items-center justify-center flex-shrink-0">
      <i data-lucide="check-circle-2" class="w-5 h-5 text-accent"></i>
    </div>
    <div>
      <p class="text-sm font-semibold text-slate-900">Conta criada!</p>
      <p class="text-xs text-slate-500 mt-0.5">Bem-vindo(a) ao VetTech 🐾</p>
    </div>
  </div>


  <!-- ═══════════════════════════════════════════════
       JAVASCRIPT — all interactions
  ═══════════════════════════════════════════════ -->
  <script>
    /* ─── Init Lucide icons ─── */
    lucide.createIcons();

    /* ═══════════════════════════════════════
       USER TYPE CARD SELECTION
    ═══════════════════════════════════════ */
    const typeCards  = document.querySelectorAll('.type-card');
    const userTypeEl = document.getElementById('userType');

    typeCards.forEach(card => {
      card.addEventListener('click', () => {
        typeCards.forEach(c => {
          c.classList.remove('selected');
          c.setAttribute('aria-pressed', 'false');
        });
        card.classList.add('selected');
        card.setAttribute('aria-pressed', 'true');
        userTypeEl.value = card.dataset.type;
      });
    });

    /* ═══════════════════════════════════════
       PASSWORD VISIBILITY TOGGLES
    ═══════════════════════════════════════ */
    function initToggle(btnId, inputId, iconId) {
      const btn   = document.getElementById(btnId);
      const input = document.getElementById(inputId);
      const icon  = document.getElementById(iconId);
      let   visible = false;
      btn.addEventListener('click', () => {
        visible = !visible;
        input.type = visible ? 'text' : 'password';
        icon.setAttribute('data-lucide', visible ? 'eye-off' : 'eye');
        lucide.createIcons();
      });
    }
    initToggle('togglePw1', 'password',        'eyeIcon1');
    initToggle('togglePw2', 'confirmPassword', 'eyeIcon2');

    /* ═══════════════════════════════════════
       PASSWORD STRENGTH METER
    ═══════════════════════════════════════ */
    const passwordEl    = document.getElementById('password');
    const strengthBar   = document.getElementById('strengthBar');
    const strengthLabel = document.getElementById('strengthLabel');

    function calcStrength(pw) {
      let score = 0;
      if (pw.length >= 8)  score++;
      if (pw.length >= 12) score++;
      if (/[A-Z]/.test(pw)) score++;
      if (/[0-9]/.test(pw)) score++;
      if (/[^A-Za-z0-9]/.test(pw)) score++;
      return score; // 0-5
    }

    passwordEl.addEventListener('input', () => {
      const pw    = passwordEl.value;
      const score = calcStrength(pw);

      const configs = [
        { w: '0%',   color: '#e2e8f0', label: 'Digite uma senha segura',  cls: 'text-slate-400' },
        { w: '20%',  color: '#f87171', label: 'Muito fraca',              cls: 'text-red-400'   },
        { w: '40%',  color: '#fb923c', label: 'Fraca',                    cls: 'text-orange-400'},
        { w: '60%',  color: '#facc15', label: 'Razoável',                 cls: 'text-yellow-500'},
        { w: '80%',  color: '#34d399', label: 'Boa',                      cls: 'text-emerald-500'},
        { w: '100%', color: '#10B981', label: 'Excelente! 🔒',            cls: 'text-accent'    },
      ];

      const cfg = pw.length === 0 ? configs[0] : configs[score] || configs[1];
      strengthBar.style.width    = pw.length === 0 ? '0%' : cfg.w;
      strengthBar.style.background = cfg.color;
      strengthLabel.textContent  = cfg.label;
      strengthLabel.className    = `text-xs mt-0.5 ${cfg.cls}`;
    });

    /* ═══════════════════════════════════════
       PHONE MASK (BR format)
    ═══════════════════════════════════════ */
    const phoneEl = document.getElementById('phone');
    phoneEl.addEventListener('input', () => {
      let v = phoneEl.value.replace(/\D/g, '').slice(0, 11);
      if (v.length > 7)      v = `(${v.slice(0,2)}) ${v.slice(2,3)} ${v.slice(3,7)}-${v.slice(7)}`;
      else if (v.length > 2) v = `(${v.slice(0,2)}) ${v.slice(2)}`;
      else if (v.length > 0) v = `(${v}`;
      phoneEl.value = v;
    });

    /* ═══════════════════════════════════════
       VALIDATION HELPERS
    ═══════════════════════════════════════ */
    function showErr(fieldId, errId, show) {
      const field = document.getElementById(fieldId);
      const err   = document.getElementById(errId);
      if (show) {
        field.classList.add('error');
        err.classList.remove('hidden');
      } else {
        field.classList.remove('error');
        err.classList.add('hidden');
      }
    }

    function validateEmail(v) { return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v); }
    function validatePhone(v) { return v.replace(/\D/g,'').length >= 10; }

    /* Clear errors on input */
    ['fullName','email','phone','password','confirmPassword'].forEach(id => {
      document.getElementById(id).addEventListener('input', () => {
        document.getElementById(id).classList.remove('error');
        const errMap = { fullName:'nameErr', email:'emailErr', phone:'phoneErr', password:'passwordErr', confirmPassword:'confirmErr' };
        document.getElementById(errMap[id])?.classList.add('hidden');
      });
    });
    document.getElementById('terms').addEventListener('change', () => {
      document.getElementById('termsErr').classList.add('hidden');
    });

    /* ═══════════════════════════════════════
       FORM SUBMIT
    ═══════════════════════════════════════ */
    const form      = document.getElementById('registerForm');
    const submitBtn = document.getElementById('submitBtn');
    const btnText   = document.getElementById('btnText');
    const btnIcon   = document.getElementById('btnIcon');
    const btnLoader = document.getElementById('btnLoader');
    const toast     = document.getElementById('successToast');

    form.addEventListener('submit', async (e) => {
      e.preventDefault();

      const name    = document.getElementById('fullName').value.trim();
      const email   = document.getElementById('email').value.trim();
      const phone   = document.getElementById('phone').value;
      const pw      = document.getElementById('password').value;
      const cpw     = document.getElementById('confirmPassword').value;
      const terms   = document.getElementById('terms').checked;

      let valid = true;

      /* Name */
      if (name.split(' ').length < 2 || name.length < 5) { showErr('fullName','nameErr',true); valid = false; }
      else showErr('fullName','nameErr',false);

      /* Email */
      if (!validateEmail(email)) { showErr('email','emailErr',true); valid = false; }
      else showErr('email','emailErr',false);

      /* Phone */
      if (!validatePhone(phone)) { showErr('phone','phoneErr',true); valid = false; }
      else showErr('phone','phoneErr',false);

      /* Password */
      if (pw.length < 8) { showErr('password','passwordErr',true); valid = false; }
      else showErr('password','passwordErr',false);

      /* Confirm password */
      if (pw !== cpw || cpw.length === 0) { showErr('confirmPassword','confirmErr',true); valid = false; }
      else showErr('confirmPassword','confirmErr',false);

      /* Terms */
      if (!terms) { document.getElementById('termsErr').classList.remove('hidden'); valid = false; }
      else document.getElementById('termsErr').classList.add('hidden');

      if (!valid) return;

      /* Loading state */
      submitBtn.disabled = true;
      btnText.textContent = 'Criando conta…';
      btnIcon.classList.add('hidden');
      btnLoader.classList.remove('hidden');

      /* Simulate API call */
      await new Promise(r => setTimeout(r, 1800));

      /* Reset button */
      submitBtn.disabled = false;
      btnText.textContent = 'Criar Conta';
      btnIcon.classList.remove('hidden');
      btnLoader.classList.add('hidden');

      /* Show success toast */
      toast.classList.remove('hidden');
      toast.classList.add('flex');
      lucide.createIcons();
      setTimeout(() => {
        toast.classList.remove('flex');
        toast.classList.add('hidden');
      }, 4000);
    });
  </script>

</body>
</html>
