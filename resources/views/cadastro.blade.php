<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>VetTech - Criar Conta</title>
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
                        brand: { DEFAULT: '#2563EB', dark: '#1d4ed8', light: '#eff6ff' },
                        accent: { DEFAULT: '#10B981', dark: '#059669', light: '#ecfdf5' },
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
        .input-field { width: 100%; border: 1px solid #cbd5e1; border-radius: 12px; padding: .78rem .9rem .78rem 2.55rem; font-size: .925rem; }
        .input-field:focus { outline: none; border-color: #2563EB; box-shadow: 0 0 0 3px rgba(37, 99, 235, .14); }
        .type-card { border: 2px solid #e2e8f0; background: #fff; }
        .type-card.selected { border-color: #2563EB; background: #eff6ff; box-shadow: 0 0 0 3px rgba(37, 99, 235, .12); }
    </style>
</head>

<body class="min-h-screen text-slate-800 antialiased">
    @php($tipoAtual = old('tipo', 'tutor'))

    <main class="grid min-h-screen lg:grid-cols-[.9fr_1.1fr]">
        <section class="hidden bg-slate-950 p-10 text-white lg:flex lg:flex-col lg:justify-between">
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-gradient-to-br from-brand to-accent">
                    <i data-lucide="heart-pulse" class="h-6 w-6"></i>
                </div>
                <span class="font-display text-2xl font-bold">VetTech</span>
            </a>
            <div class="max-w-md">
                <p class="mb-3 inline-flex rounded-full bg-white/10 px-3 py-1 text-sm font-bold text-accent">Cadastro gratuito</p>
                <h1 class="font-display text-4xl font-extrabold leading-tight">Cuidado conectado para pets, tutores e clinicas.</h1>
                <p class="mt-5 text-lg text-slate-300">Crie sua conta para gerenciar animais, consultas, vacinas, telemedicina e historico de atendimentos.</p>
            </div>
            <p class="text-sm text-slate-400">Dados protegidos e acesso imediato apos o login.</p>
        </section>

        <section class="flex items-start justify-center px-4 py-8 sm:px-8">
            <div class="w-full max-w-3xl rounded-3xl border border-slate-200 bg-white p-6 shadow-xl sm:p-8">
                <div class="mb-7 text-center">
                    <div class="mx-auto mb-3 flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-brand to-accent text-white">
                        <i data-lucide="heart-pulse" class="h-7 w-7"></i>
                    </div>
                    <h2 class="font-display text-2xl font-extrabold text-slate-950">Crie sua conta</h2>
                    <p class="mt-1 text-sm text-slate-500">Preencha os dados para acessar a area do cliente.</p>
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

                <form id="registerForm" action="{{ route('cadastro.post') }}" method="POST" class="space-y-6">
                    @csrf
                    <input id="userType" type="hidden" name="tipo" value="{{ $tipoAtual }}">

                    <div>
                        <p class="mb-3 text-sm font-bold text-slate-700">Voce e...</p>
                        <div class="grid gap-3 sm:grid-cols-3">
                            <button type="button" data-type="tutor" class="type-card rounded-2xl p-4 text-center {{ $tipoAtual === 'tutor' ? 'selected' : '' }}">
                                <i data-lucide="heart" class="mx-auto mb-2 h-6 w-6 text-brand"></i>
                                <span class="text-sm font-bold">Tutor</span>
                            </button>
                            <button type="button" data-type="vet" class="type-card rounded-2xl p-4 text-center {{ $tipoAtual === 'vet' ? 'selected' : '' }}">
                                <i data-lucide="stethoscope" class="mx-auto mb-2 h-6 w-6 text-brand"></i>
                                <span class="text-sm font-bold">Veterinario</span>
                            </button>
                            <button type="button" data-type="clinic" class="type-card rounded-2xl p-4 text-center {{ $tipoAtual === 'clinic' ? 'selected' : '' }}">
                                <i data-lucide="building-2" class="mx-auto mb-2 h-6 w-6 text-brand"></i>
                                <span class="text-sm font-bold">Clinica</span>
                            </button>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="fullName">Nome completo</label>
                            <div class="relative">
                                <i data-lucide="user" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="fullName" name="name" class="input-field" value="{{ old('name') }}" autocomplete="name" required>
                            </div>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="email">Email</label>
                            <div class="relative">
                                <i data-lucide="mail" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="email" name="email" type="email" class="input-field" value="{{ old('email') }}" autocomplete="email" required>
                            </div>
                        </div>

                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="phone">Telefone</label>
                            <div class="relative">
                                <i data-lucide="phone" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="phone" name="phone" class="input-field" value="{{ old('phone') }}" placeholder="(11) 90000-0000" inputmode="numeric" required>
                            </div>
                        </div>

                        <div id="cpfWrapper">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="cpf">CPF</label>
                            <div class="relative">
                                <i data-lucide="badge-check" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="cpf" name="cpf" class="input-field" value="{{ old('cpf') }}" placeholder="000.000.000-00" inputmode="numeric">
                            </div>
                        </div>

                        <div id="crmvWrapper">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="crmv">CRMV</label>
                            <div class="relative">
                                <i data-lucide="clipboard-check" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="crmv" name="crmv" class="input-field uppercase" value="{{ old('crmv') }}" placeholder="SP-12345">
                            </div>
                        </div>

                        <div id="cnpjWrapper" class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="cnpj">CNPJ</label>
                            <div class="relative">
                                <i data-lucide="landmark" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="cnpj" name="cnpj" class="input-field" value="{{ old('cnpj') }}" placeholder="00.000.000/0000-00" inputmode="numeric">
                            </div>
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-6">
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="cep">CEP</label>
                            <input id="cep" name="cep" class="input-field !pl-4" value="{{ old('cep') }}" placeholder="00000-000" inputmode="numeric">
                        </div>
                        <div class="sm:col-span-4">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="street">Logradouro</label>
                            <input id="street" name="logradouro" class="input-field !pl-4" value="{{ old('logradouro') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="number">Numero</label>
                            <input id="number" name="numero" class="input-field !pl-4" value="{{ old('numero') }}">
                        </div>
                        <div class="sm:col-span-2">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="neighborhood">Bairro</label>
                            <input id="neighborhood" name="bairro" class="input-field !pl-4" value="{{ old('bairro') }}">
                        </div>
                        <div class="sm:col-span-1">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="city">Cidade</label>
                            <input id="city" name="cidade" class="input-field !pl-4" value="{{ old('cidade') }}">
                        </div>
                        <div class="sm:col-span-1">
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="uf">UF</label>
                            <input id="uf" name="uf" maxlength="2" class="input-field !pl-4 uppercase" value="{{ old('uf') }}">
                        </div>
                    </div>

                    <div class="grid gap-4 sm:grid-cols-2">
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="password">Senha</label>
                            <div class="relative">
                                <i data-lucide="lock" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="password" name="password" type="password" class="input-field" autocomplete="new-password" required>
                            </div>
                        </div>
                        <div>
                            <label class="mb-1.5 block text-sm font-bold text-slate-700" for="password_confirmation">Confirmar senha</label>
                            <div class="relative">
                                <i data-lucide="lock-keyhole" class="absolute left-3 top-1/2 h-4 w-4 -translate-y-1/2 text-slate-400"></i>
                                <input id="password_confirmation" name="password_confirmation" type="password" class="input-field" autocomplete="new-password" required>
                            </div>
                        </div>
                    </div>

                    <label class="flex gap-3 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
                        <input type="checkbox" name="terms" class="mt-1" required>
                        <span>Li e concordo com os Termos de Uso e a Politica de Privacidade da VetTech.</span>
                    </label>

                    <button type="submit" class="flex w-full items-center justify-center gap-2 rounded-2xl bg-brand px-5 py-3.5 font-bold text-white transition hover:bg-brand-dark">
                        Criar conta
                        <i data-lucide="arrow-right" class="h-4 w-4"></i>
                    </button>
                </form>

                <p class="mt-6 text-center text-sm text-slate-500">
                    Ja tem conta?
                    <a href="{{ route('login') }}" class="font-bold text-brand hover:underline">Fazer login</a>
                </p>
            </div>
        </section>
    </main>

    <script>
        lucide.createIcons();

        const typeCards = document.querySelectorAll('.type-card');
        const typeInput = document.getElementById('userType');
        const cpfWrapper = document.getElementById('cpfWrapper');
        const crmvWrapper = document.getElementById('crmvWrapper');
        const cnpjWrapper = document.getElementById('cnpjWrapper');
        const cpfInput = document.getElementById('cpf');
        const crmvInput = document.getElementById('crmv');
        const cnpjInput = document.getElementById('cnpj');

        function updateType(type) {
            typeInput.value = type;
            typeCards.forEach(card => card.classList.toggle('selected', card.dataset.type === type));
            const showCpf = type !== 'clinic';
            const showCrmv = type === 'vet';
            const showCnpj = type === 'clinic';
            cpfWrapper.classList.toggle('hidden', !showCpf);
            crmvWrapper.classList.toggle('hidden', !showCrmv);
            cnpjWrapper.classList.toggle('hidden', !showCnpj);
            cpfInput.disabled = !showCpf;
            crmvInput.disabled = !showCrmv;
            cnpjInput.disabled = !showCnpj;
            cpfInput.required = showCpf;
            crmvInput.required = showCrmv;
            cnpjInput.required = showCnpj;
        }

        typeCards.forEach(card => card.addEventListener('click', () => updateType(card.dataset.type)));
        updateType(typeInput.value || 'tutor');

        function onlyDigits(value, max) {
            return value.replace(/\D/g, '').slice(0, max);
        }

        function maskPhone(value) {
            const v = onlyDigits(value, 11);
            if (v.length > 10) return `(${v.slice(0, 2)}) ${v.slice(2, 7)}-${v.slice(7)}`;
            if (v.length > 6) return `(${v.slice(0, 2)}) ${v.slice(2, 6)}-${v.slice(6)}`;
            if (v.length > 2) return `(${v.slice(0, 2)}) ${v.slice(2)}`;
            return v ? `(${v}` : '';
        }

        function maskCpf(value) {
            const v = onlyDigits(value, 11);
            if (v.length > 9) return `${v.slice(0, 3)}.${v.slice(3, 6)}.${v.slice(6, 9)}-${v.slice(9)}`;
            if (v.length > 6) return `${v.slice(0, 3)}.${v.slice(3, 6)}.${v.slice(6)}`;
            if (v.length > 3) return `${v.slice(0, 3)}.${v.slice(3)}`;
            return v;
        }

        function maskCnpj(value) {
            const v = onlyDigits(value, 14);
            if (v.length > 12) return `${v.slice(0, 2)}.${v.slice(2, 5)}.${v.slice(5, 8)}/${v.slice(8, 12)}-${v.slice(12)}`;
            if (v.length > 8) return `${v.slice(0, 2)}.${v.slice(2, 5)}.${v.slice(5, 8)}/${v.slice(8)}`;
            if (v.length > 5) return `${v.slice(0, 2)}.${v.slice(2, 5)}.${v.slice(5)}`;
            if (v.length > 2) return `${v.slice(0, 2)}.${v.slice(2)}`;
            return v;
        }

        function maskCep(value) {
            const v = onlyDigits(value, 8);
            return v.length > 5 ? `${v.slice(0, 5)}-${v.slice(5)}` : v;
        }

        const phone = document.getElementById('phone');
        const cep = document.getElementById('cep');
        phone.addEventListener('input', () => phone.value = maskPhone(phone.value));
        cpfInput.addEventListener('input', () => cpfInput.value = maskCpf(cpfInput.value));
        cnpjInput.addEventListener('input', () => cnpjInput.value = maskCnpj(cnpjInput.value));
        cep.addEventListener('input', () => cep.value = maskCep(cep.value));
        crmvInput.addEventListener('input', () => {
            let v = crmvInput.value.toUpperCase().replace(/[^A-Z0-9]/g, '').slice(0, 12);
            crmvInput.value = v.length > 2 ? `${v.slice(0, 2)}-${v.slice(2)}` : v;
        });

        phone.value = maskPhone(phone.value);
        cpfInput.value = maskCpf(cpfInput.value);
        cnpjInput.value = maskCnpj(cnpjInput.value);
        cep.value = maskCep(cep.value);

        cep.addEventListener('blur', async () => {
            const digits = onlyDigits(cep.value, 8);
            if (digits.length !== 8) return;
            try {
                const response = await fetch(`https://viacep.com.br/ws/${digits}/json/`);
                const data = await response.json();
                if (!data.erro) {
                    document.getElementById('street').value ||= data.logradouro || '';
                    document.getElementById('neighborhood').value ||= data.bairro || '';
                    document.getElementById('city').value ||= data.localidade || '';
                    document.getElementById('uf').value ||= data.uf || '';
                }
            } catch (_) {}
        });
    </script>
</body>

</html>
