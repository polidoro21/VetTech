@extends('layouts.app')

@section('title', 'Pagamento')

@section('page-title', 'Pagamento')

@section('content')

<div class="container">

    <div class="card p-4 shadow">

        <h4 class="mb-4">💳 Finalizar Pagamento</h4>

        <!-- Valor -->
        <h5>Total: R$ <span id="total">100.00</span></h5>

        <!-- Cupom -->
        <div class="mt-3">
            <label>Cupom de desconto:</label>
            <div class="d-flex gap-2">
                <input type="text" id="cupom" class="form-control" placeholder="Digite seu cupom">
                <button class="btn btn-primary" onclick="aplicarCupom()">Aplicar</button>
            </div>
            <small id="msgCupom"></small>
        </div>

        <hr>

        <!-- Forma de pagamento -->
        <h5>Escolha a forma de pagamento:</h5>

        <div class="mt-3">
            <button class="btn btn-outline-success m-1" onclick="mostrarPix()">PIX</button>
            <button class="btn btn-outline-primary m-1" onclick="mostrarCartao()">Cartão</button>
        </div>

        <!-- PIX -->
        <div id="pixArea" class="mt-4" style="display:none;">
            <h5>Pagamento via PIX</h5>

            <p><strong>Chave PIX:</strong> 18991803040</p>

            <!-- QR CODE CORRIGIDO -->
            <img
                src="https://api.qrserver.com/v1/create-qr-code/?size=200x200&data=18991803040"
                class="img-fluid"
                alt="QR Code PIX"
            >

            <p class="mt-2 text-muted">Escaneie o QR Code para pagar</p>
        </div>

        <!-- Cartão -->
        <div id="cartaoArea" class="mt-4" style="display:none;">

            <h5>Pagamento com Cartão</h5>

            <input type="text" class="form-control mb-2" placeholder="Número do cartão">
            <input type="text" class="form-control mb-2" placeholder="Nome no cartão">

            <div class="d-flex gap-2">
                <input type="text" class="form-control" placeholder="Validade (MM/AA)">
                <input type="text" class="form-control" placeholder="CVV">
            </div>

            <select class="form-control mt-2">
                <option>Débito</option>
                <option>Crédito</option>
            </select>

        </div>

        <button class="btn btn-success mt-4 w-100">
            Confirmar Pagamento
        </button>

    </div>

</div>

<script>
function mostrarPix() {
    document.getElementById('pixArea').style.display = 'block';
    document.getElementById('cartaoArea').style.display = 'none';
}

function mostrarCartao() {
    document.getElementById('pixArea').style.display = 'none';
    document.getElementById('cartaoArea').style.display = 'block';
}

function aplicarCupom() {
    let cupom = document.getElementById('cupom').value.toUpperCase();
    let total = document.getElementById('total');
    let msg = document.getElementById('msgCupom');

    if (cupom === "DESCONTO10") {
        total.innerText = "90.00";
        msg.innerText = "Cupom aplicado! 10% de desconto.";
        msg.style.color = "green";
    } else {
        msg.innerText = "Cupom inválido!";
        msg.style.color = "red";
    }
}
</script>

@endsection
