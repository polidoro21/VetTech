@extends('layouts.app')

@section('content')

<style>
    main {
        text-align: center;
        padding: 60px 20px;
    }

    h2 {
        color: #6a0dad;
        font-size: 32px;
    }

    p {
        font-size: 18px;
        margin: 15px 0;
    }

    .btn {
        background: gold;
        color: black;
        padding: 12px 25px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: bold;
        display: inline-block;
        margin-top: 20px;
        transition: 0.3s;
    }

    .btn:hover {
        transform: scale(1.05);
    }

    .section {
        margin-top: 60px;
    }

    .faq {
        max-width: 700px;
        margin: auto;
        text-align: left;
    }

    .faq-item {
        background: white;
        margin-bottom: 10px;
        border-radius: 8px;
        box-shadow: 0 0 10px #ddd;
        overflow: hidden;
    }

    .faq-question {
        padding: 15px;
        cursor: pointer;
        font-weight: bold;
        background: #6a0dad;
        color: white;
    }

    .faq-answer {
        display: none;
        padding: 15px;
    }
</style>

<main>
    <h2>🐾 Bem-vinda!</h2>

    <p>
        O VetTech Care é um sistema que mostra como a tecnologia pode transformar
        o atendimento veterinário, tornando-o mais rápido, eficiente e humanizado.
    </p>

    @auth
        <p><strong>Bem-vindos, {{ auth()->user()->name }}! 💜</strong></p>
    @else
        <p><strong>Bem-vindos, TechLovers! 💜</strong></p>
    @endauth

    <a href="/novo-pet" class="btn">Cadastrar um Animal</a>

    <!-- BENEFÍCIOS -->
    <div class="section">
        <h2>Por que usar o VetTech?</h2>

        <p>✔ Organização completa da clínica</p>
        <p>✔ Cadastro de animais simplificado</p>
        <p>✔ Atendimento mais rápido</p>
    </div>

    <!-- FAQ -->
    <div class="section">
        <h2>Perguntas Frequentes ❓</h2>

        <div class="faq">

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    O que é o VetTech?
                </div>
                <div class="faq-answer">
                    É um sistema que ajuda clínicas veterinárias a organizarem atendimentos e pacientes.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    Preciso pagar para usar?
                </div>
                <div class="faq-answer">
                    Não! Você pode começar gratuitamente.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    Posso cadastrar vários animais?
                </div>
                <div class="faq-answer">
                    Sim, você pode cadastrar quantos quiser.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFAQ(this)">
                    Funciona no celular?
                </div>
                <div class="faq-answer">
                    Sim, o sistema é totalmente responsivo.
                </div>
            </div>

        </div>
    </div>

</main>

<script>
    function toggleFAQ(element) {
        const answer = element.nextElementSibling;

        if (answer.style.display === "block") {
            answer.style.display = "none";
        } else {
            answer.style.display = "block";
        }
    }
</script>

@endsection
