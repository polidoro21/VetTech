@extends('layouts.app')

@section('content')
<section class="conteudo">
    <h2>Buscar Clínicas Veterinárias</h2>

    <input type="text" id="endereco" placeholder="Digite sua cidade, endereço ou CEP">

    <button onclick="buscarClinicas()">Buscar</button>

    <div id="resultado" style="margin-top:20px;"></div>
</section>

<script>
function buscarClinicas() {
    let endereco = document.getElementById('endereco').value;

    if(endereco === '') {
        alert('Digite um endereço!');
        return;
    }

    let url = "https://www.google.com/maps/search/clinica+veterinaria+perto+de+" + encodeURIComponent(endereco);

    window.open(url, '_blank');
}
</script>
@endsection
