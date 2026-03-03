<form action="{{ route('animais.store') }}" method="POST">
    @csrf

    <input type="text" name="nome">
    <input type="text" name="especie">
    <input type="text" name="raca">
    <input type="number" name="idade">
    <input type="text" name="nome_dono">

    <button type="submit">Salvar</button>
</form>
