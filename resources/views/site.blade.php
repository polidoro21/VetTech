<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetTech - Atendimento veterinario em minutos</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { brand: '#2563EB', accent: '#10B981' },
                    fontFamily: { sans: ['DM Sans', 'sans-serif'], display: ['Sora', 'sans-serif'] },
                },
            },
        };
    </script>
    <style>
        body { font-family: 'DM Sans', sans-serif; }
        .hero-bg {
            background-image:
                linear-gradient(90deg, rgba(15,23,42,.88), rgba(15,23,42,.54), rgba(15,23,42,.22)),
                url('https://images.unsplash.com/photo-1628009368231-7bb7cfcb0def?auto=format&fit=crop&w=1920&q=80');
            background-position: center;
            background-size: cover;
        }
        .btn { display: inline-flex; align-items: center; justify-content: center; gap: .5rem; border-radius: 999px; font-weight: 800; transition: .18s ease; }
        .btn:hover { transform: translateY(-1px); }
    </style>
</head>

<body class="bg-white text-slate-800 antialiased">
    <header class="fixed inset-x-0 top-0 z-40 border-b border-white/10 bg-slate-950/70 backdrop-blur">
        <nav class="mx-auto flex h-16 max-w-7xl items-center justify-between px-5">
            <a href="{{ route('home') }}" class="flex items-center gap-2 font-display text-xl font-bold text-white">
                <span class="flex h-9 w-9 items-center justify-center rounded-xl bg-brand">
                    <i data-lucide="heart-pulse" class="h-5 w-5"></i>
                </span>
                VetTech
            </a>
            <div class="hidden items-center gap-6 text-sm font-bold text-white/80 md:flex">
                <a href="#tutores" class="hover:text-white">Tutores</a>
                <a href="#vets" class="hover:text-white">Veterinarios</a>
                <a href="#clinicas" class="hover:text-white">Clinicas</a>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('login') }}" class="hidden rounded-full px-4 py-2 text-sm font-bold text-white hover:bg-white/10 sm:inline-flex">Login</a>
                <a href="{{ route('cadastro') }}" class="rounded-full bg-white px-4 py-2 text-sm font-extrabold text-slate-950">Criar conta</a>
            </div>
        </nav>
    </header>

    <main>
        <section class="hero-bg flex min-h-[92vh] items-center pt-16 text-white">
            <div class="mx-auto grid w-full max-w-7xl gap-10 px-5 py-20 lg:grid-cols-[1fr_.78fr] lg:items-center">
                <div class="max-w-2xl">
                    <p class="mb-5 inline-flex items-center gap-2 rounded-full bg-white/15 px-4 py-2 text-sm font-bold backdrop-blur">
                        <i data-lucide="zap" class="h-4 w-4 text-emerald-300"></i>
                        Atendimento por chat ou video
                    </p>
                    <h1 class="font-display text-4xl font-extrabold leading-tight md:text-6xl">VetTech</h1>
                    <p class="mt-5 text-xl leading-relaxed text-white/86">
                        Tutores entram na fila, veterinarios disponiveis aceitam o chamado e o resultado fica salvo com anotacoes e receita.
                    </p>
                    <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('atendimentos.create') }}" class="btn bg-brand px-6 py-3.5 text-white shadow-xl shadow-blue-900/30">
                            <i data-lucide="messages-square" class="h-5 w-5"></i>
                            Solicitar atendimento
                        </a>
                        <a href="{{ route('clinicas.register') }}" class="btn border border-white/60 bg-white/10 px-6 py-3.5 text-white backdrop-blur">
                            <i data-lucide="building-2" class="h-5 w-5"></i>
                            Cadastrar clinica
                        </a>
                    </div>
                </div>

                <div class="rounded-3xl border border-white/15 bg-white/12 p-5 backdrop-blur">
                    <div class="rounded-2xl bg-white p-5 text-slate-900 shadow-2xl">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-bold text-slate-400">Fila ao vivo</p>
                                <p class="font-display text-2xl font-extrabold">Sala de espera</p>
                            </div>
                            <span class="rounded-full bg-emerald-50 px-3 py-1 text-xs font-extrabold text-emerald-600">Online</span>
                        </div>
                        <div class="mt-5 space-y-3">
                            <div class="rounded-2xl border border-slate-200 bg-slate-50 p-4">
                                <p class="font-bold text-slate-900">Luna · Gato</p>
                                <p class="mt-1 text-sm text-slate-500">Tutor em Sao Paulo - SP · Chat</p>
                                <p class="mt-2 text-sm text-slate-700">Sem apetite desde ontem e mais quieta que o normal.</p>
                            </div>
                            <div class="grid grid-cols-2 gap-3">
                                <div class="rounded-2xl bg-blue-50 p-4">
                                    <p class="text-2xl font-extrabold text-brand">2 min</p>
                                    <p class="text-xs font-bold text-slate-500">tempo medio de aceite</p>
                                </div>
                                <div class="rounded-2xl bg-emerald-50 p-4">
                                    <p class="text-2xl font-extrabold text-accent">100%</p>
                                    <p class="text-xs font-bold text-slate-500">clinicas aprovadas</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="tutores" class="bg-slate-50 py-20">
            <div class="mx-auto max-w-7xl px-5">
                <div class="max-w-2xl">
                    <p class="text-sm font-extrabold uppercase tracking-wide text-brand">Para tutores</p>
                    <h2 class="mt-2 font-display text-3xl font-extrabold text-slate-950">Um unico caminho: Atendimento.</h2>
                    <p class="mt-3 text-slate-600">Sem duplicidade entre consulta e teleatendimento. O tutor escolhe o pet, descreve o problema e aguarda um veterinario aceitar.</p>
                </div>
                <div class="mt-10 grid gap-5 md:grid-cols-3">
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <i data-lucide="paw-print" class="mb-4 h-8 w-8 text-brand"></i>
                        <h3 class="font-display text-lg font-bold text-slate-950">Escolha o pet</h3>
                        <p class="mt-2 text-sm text-slate-500">O veterinario ve especie, porte, idade e sintomas, sem dados sensiveis do tutor.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <i data-lucide="message-circle" class="mb-4 h-8 w-8 text-accent"></i>
                        <h3 class="font-display text-lg font-bold text-slate-950">Chat ou video</h3>
                        <p class="mt-2 text-sm text-slate-500">A sala compartilhada concentra conversa, link externo de video e status.</p>
                    </div>
                    <div class="rounded-2xl border border-slate-200 bg-white p-6">
                        <i data-lucide="file-heart" class="mb-4 h-8 w-8 text-amber-500"></i>
                        <h3 class="font-display text-lg font-bold text-slate-950">Resultado salvo</h3>
                        <p class="mt-2 text-sm text-slate-500">Depois do atendimento, anotacoes e receita ficam disponiveis ao tutor.</p>
                    </div>
                </div>
            </div>
        </section>

        <section id="vets" class="py-20">
            <div class="mx-auto grid max-w-7xl gap-10 px-5 lg:grid-cols-2 lg:items-center">
                <img src="https://images.unsplash.com/photo-1576201836106-db1758fd1c97?auto=format&fit=crop&w=1100&q=80" alt="Veterinario examinando cachorro" class="h-[420px] w-full rounded-3xl object-cover">
                <div>
                    <p class="text-sm font-extrabold uppercase tracking-wide text-accent">Para veterinarios</p>
                    <h2 class="mt-2 font-display text-3xl font-extrabold text-slate-950">Entre em disponibilidade e aceite atendimentos como uma sala de espera digital.</h2>
                    <p class="mt-4 text-slate-600">O veterinario ve chamados abertos, aceita ou recusa, conversa com o tutor e finaliza com descricao clinica, anotacoes e receita anexada.</p>
                    <a href="{{ route('cadastro', ['tipo' => 'vet']) }}" class="btn mt-7 bg-slate-950 px-6 py-3.5 text-white">
                        <i data-lucide="stethoscope" class="h-5 w-5"></i>
                        Cadastrar como veterinario
                    </a>
                </div>
            </div>
        </section>

        <section id="clinicas" class="bg-slate-950 py-20 text-white">
            <div class="mx-auto grid max-w-7xl gap-10 px-5 lg:grid-cols-[.9fr_1fr] lg:items-center">
                <div>
                    <p class="text-sm font-extrabold uppercase tracking-wide text-emerald-300">Para clinicas</p>
                    <h2 class="mt-2 font-display text-3xl font-extrabold">Cadastro com aprovacao administrativa.</h2>
                    <p class="mt-4 text-slate-300">A clinica cria uma conta, completa os dados publicos e aguarda aprovacao. Alteracoes futuras tambem passam por revisao antes de aparecerem para tutores.</p>
                    <div class="mt-7 flex flex-col gap-3 sm:flex-row">
                        <a href="{{ route('clinicas.register') }}" class="btn bg-white px-6 py-3.5 text-slate-950">
                            <i data-lucide="building-2" class="h-5 w-5"></i>
                            Cadastrar clinica
                        </a>
                        <a href="{{ route('clinicas.index') }}" class="btn border border-white/30 px-6 py-3.5 text-white">
                            <i data-lucide="search" class="h-5 w-5"></i>
                            Ver clinicas
                        </a>
                    </div>
                </div>
                <div class="grid gap-4 sm:grid-cols-2">
                    <div class="rounded-3xl bg-white/10 p-6">
                        <i data-lucide="shield-check" class="mb-4 h-9 w-9 text-emerald-300"></i>
                        <h3 class="font-display text-lg font-bold">Revisao do admin</h3>
                        <p class="mt-2 text-sm text-slate-300">Clinicas pendentes nao aparecem na busca publica.</p>
                    </div>
                    <div class="rounded-3xl bg-white/10 p-6">
                        <i data-lucide="refresh-cw" class="mb-4 h-9 w-9 text-blue-300"></i>
                        <h3 class="font-display text-lg font-bold">Mudancas moderadas</h3>
                        <p class="mt-2 text-sm text-slate-300">Edicoes aguardam autorizacao sem derrubar a versao aprovada.</p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white py-10">
        <div class="mx-auto flex max-w-7xl flex-col gap-4 px-5 text-sm text-slate-500 md:flex-row md:items-center md:justify-between">
            <p class="font-bold text-slate-700">VetTech</p>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('login') }}" class="hover:text-brand">Login</a>
                <a href="{{ route('cadastro') }}" class="hover:text-brand">Cadastro</a>
                <a href="{{ route('clinicas.register') }}" class="hover:text-brand">Cadastro de clinica</a>
            </div>
        </div>
    </footer>

    <script>
        lucide.createIcons();
    </script>
</body>

</html>
