
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>VetTech</title>

    <style>
        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f9f9fb;
        }

        .hero {
            background: linear-gradient(135deg, #6a0dad, #b57edc);
            color: white;
            text-align: center;
            padding: 100px 20px;
        }

        .hero h1 {
            font-size: 42px;
        }

        .hero p {
            font-size: 18px;
            margin: 20px 0;
        }

        .btn {
            background: gold;
            color: black;
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.3s;
        }

        .btn:hover {
            transform: scale(1.05);
        }

        .section {
            padding: 50px 20px;
            text-align: center;
        }

        .posts {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }

        .card {
            width: 260px;
            margin: 15px;
            padding: 20px;
            background: white;
            border-radius: 12px;
            box-shadow: 0 0 10px #ddd;
            transition: 0.3s;
        }

        .card:hover {
            transform: translateY(-8px);
        }

        .cta {
            background: #6a0dad;
            color: white;
            padding: 60px 20px;
        }

        input {
            padding: 10px;
            margin: 8px;
            width: 220px;
            border-radius: 6px;
            border: none;
        }

        .form-box {
            margin-top: 20px;
        }

        footer {
            text-align: center;
            padding: 20px;
            background: #eee;
            font-size: 14px;
        }
    </style>
</head>

<body>

    <!-- HERO -->
    <div class="hero">
        <h1>🐾 VetTech</h1>
        <p>Transformando o cuidado veterinário com tecnologia</p>
        <button class="btn" onclick="mostrarCadastro()">Começar agora</button>
    </div>

    <!-- SOBRE -->
    <div class="section">
        <h2>Sobre o VetTech</h2>
        <p>Uma plataforma inteligente para clínicas veterinárias gerenciarem atendimentos, pacientes e informações com eficiência.</p>
    </div>

    <!-- POSTS / CONTEÚDO -->
    <div class="section">
        <h2>Dicas e novidades 🐶</h2>

        <div class="posts">
            <div class="card">
                <h3>🐕 Cuidados com seu pet</h3>
                <p>Saiba como manter seu animal saudável no dia a dia.</p>
            </div>

            <div class="card">
                <h3>💉 Vacinação</h3>
                <p>A importância das vacinas para cães e gatos.</p>
            </div>

            <div class="card">
                <h3>🏥 Gestão eficiente</h3>
                <p>Organize sua clínica com tecnologia moderna.</p>
            </div>
        </div>
    </div>

    <!-- BENEFÍCIOS -->
    <div class="section">
        <h2>Por que usar o VetTech?</h2>

        <div class="posts">
            <div class="card">
                <h3>📋 Organização</h3>
                <p>Controle total dos atendimentos</p>
            </div>

            <div class="card">
                <h3>🐾 Cadastro completo</h3>
                <p>Informações detalhadas dos pacientes</p>
            </div>

            <div class="card">
                <h3>⚡ Agilidade</h3>
                <p>Atendimento mais rápido e eficiente</p>
            </div>
        </div>
    </div>

    <!-- CTA -->
    <div class="cta">
        <h2>🚀 Comece gratuitamente</h2>
        <p>Cadastre-se e leve sua clínica para o próximo nível</p>

        <div id="formCadastro" class="form-box" style="display:none;">
            <input type="text" placeholder="Nome completo" required>
            <input type="email" placeholder="Email" required>
            <input type="password" placeholder="Senha" required>
            <br>
            <button class="btn" onclick="cadastrar()">Cadastrar</button>
        </div>
    </div>

    <!-- RODAPÉ -->
    <footer>
        © 2026 VetTech • Sistema Veterinário
    </footer>

    <script>
        function mostrarCadastro() {
            document.getElementById('formCadastro').style.display = 'block';
        }

        function cadastrar() {
            alert("Cadastro realizado com sucesso! 🐾");
        }

        // Gatilho automático
        window.onload = function() {
            setTimeout(() => {
                document.getElementById('formCadastro').style.display = 'block';
            }, 2500);
        }
    </script>

</body>
</html>
