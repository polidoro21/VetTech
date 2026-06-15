<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetTech - Cadastro de Clinica</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/lucide@latest/dist/umd/lucide.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700;800&family=Sora:wght@600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'DM Sans', sans-serif; background: #f8fafc; }
        .input-field { width: 100%; border: 1px solid #cbd5e1; border-radius: 12px; padding: .78rem .9rem; font-size: .925rem; }
        .input-field:focus { outline: none; border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37, 99, 235, .14); }
    </style>
</head>

<body class="min-h-screen text-slate-800 antialiased">
    <main class="grid min-h-screen lg:grid-cols-[.9fr_1.1fr]">
        <section class="hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-blue-600">
                    <i data-lucide="heart-pulse" class="h-6 w-6"></i>
                </div>
                <span class="font-display text-2xl font-bold">VetTech</span>
            </a>
            <div class="max-w-md">
                <p class="mb-3 inline-flex rounded-full bg-white/10 px-3 py-1 text-sm font-bold text-emerald-300">Clinicas parceiras</p>
                <h1 class="font-display text-4xl font-extrabold leading-tight">Cadastre sua clinica e aguarde a aprovacao.</h1>
                <p class="mt-5 text-lg text-slate-300">Depois da conta criada, voce completa o perfil publico. O admin revisa antes de publicar.</p>
            </div>
            <p class="text-sm text-slate-400">Apenas clinicas aprovadas aparecem para tutores.</p>
        </section>

        <section class="flex items-center justify-center px-4 py-8 sm:px-8">
            <div class="w-full max-w-xl rounded-3xl border border-slate-200 bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-7 text-center">
                    <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-blue-600 text-white">
                        <i data-lucide="building-2" class="h-7 w-7"></i>
                    </div>
                    <h2 class="font-display text-2xl font-extrabold text-slate-950">Cadastro da clinica</h2>
                    <p class="mt-1 text-sm text-slate-500">Crie o usuario responsavel para completar os dados depois.</p>
                </div>

                @if($errors->any())
                    <div class="mb-5 rounded-2xl border border-red-200 bg-red-50 p-4 text-sm text-red-700">
                        <p class="mb-1 font-bold">Corrija os campos abaixo:</p>
                        <ul class="list-inside list-disc">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('clinicas.register.post') }}" method="POST" class="space-y-5">
                    @csrf
                    <div>
                        <label class="mb-1.5 block text-sm font-bold text-slate-700" for="name">Responsavel</label>
                        <input id="name" name="name" class="input-field" value="{{ old('name') }}" required>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="email">Email</label>
                            <input id="email" name="email" type="email" class="input-field" value="{{ old('email') }}" required>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="phone">Telefone</label>
                            <input id="phone" name="phone" class="input-field" value="{{ old('phone') }}" placeholder="(11) 3333-4444" required>
                        </div>
                    </div>
                    <div>
                        <label class="mb-1.5 block text-sm font-bold text-slate-700" for="cnpj">CNPJ</label>
                        <input id="cnpj" name="cnpj" class="input-field" value="{{ old('cnpj') }}" placeholder="00.000.000/0000-00" required>
                    </div>
                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="password">Senha</label>
                            <input id="password" name="password" type="password" class="input-field" required>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="password_confirmation">Confirmar senha</label>
                            <input id="password_confirmation" name="password_confirmation" type="password" class="input-field" required>
                        </div>
                    </div>
                    <label class="flex gap-3 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                        <input type="checkbox" name="terms" class="mt-1" required>
                        <span>Li e concordo com os Termos de Uso e a Politica de Privacidade.</span>
                    </label>
                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-blue-600 px-5 py-3.5 font-bold text-white transition hover:bg-blue-700">
                        Criar conta da clinica
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Ja tem conta?
                    <a href="{{ route('login') }}" class="font-bold text-blue-600 hover:underline">Fazer login</a>
                </p>
            </div>
        </section>
    </main>

    <script>
        lucide.createIcons();
        function onlyDigits(value, max) { return value.replace(/\D/g, '').slice(0, max); }
        const phone = document.getElementById('phone');
        const cnpj = document.getElementById('cnpj');
        phone.addEventListener('input', () => {
            const v = onlyDigits(phone.value, 11);
            phone.value = v.length > 10 ? `(${v.slice(0, 2)}) ${v.slice(2, 7)}-${v.slice(7)}` : v.length > 6 ? `(${v.slice(0, 2)}) ${v.slice(2, 6)}-${v.slice(6)}` : v.length > 2 ? `(${v.slice(0, 2)}) ${v.slice(2)}` : v;
        });
        cnpj.addEventListener('input', () => {
            const v = onlyDigits(cnpj.value, 14);
            cnpj.value = v.length > 12 ? `${v.slice(0, 2)}.${v.slice(2, 5)}.${v.slice(5, 8)}/${v.slice(8, 12)}-${v.slice(12)}` : v.length > 8 ? `${v.slice(0, 2)}.${v.slice(2, 5)}.${v.slice(5, 8)}/${v.slice(8)}` : v.length > 5 ? `${v.slice(0, 2)}.${v.slice(2, 5)}.${v.slice(5)}` : v.length > 2 ? `${v.slice(0, 2)}.${v.slice(2)}` : v;
        });
    </script>
</body>

</html>
