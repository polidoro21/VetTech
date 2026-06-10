@php
    $selectedPorte = old('porte', $animal->porte ?? '');
@endphp

<div class="grid gap-5 md:grid-cols-2">
    <div class="md:col-span-2">
        <label class="vt-label" for="nome">Nome</label>
        <input id="nome" name="nome" class="vt-input" value="{{ old('nome', $animal->nome ?? '') }}" required>
    </div>
    <div>
        <label class="vt-label" for="especie">Especie</label>
        <input id="especie" name="especie" class="vt-input" value="{{ old('especie', $animal->especie ?? '') }}" required>
    </div>
    <div>
        <label class="vt-label" for="raca">Raca</label>
        <input id="raca" name="raca" class="vt-input" value="{{ old('raca', $animal->raca ?? '') }}">
    </div>
    <div>
        <label class="vt-label" for="data_nascimento">Data de nascimento</label>
        <input id="data_nascimento" type="date" name="data_nascimento" class="vt-input" value="{{ old('data_nascimento', optional($animal?->data_nascimento ?? null)->format('Y-m-d')) }}">
    </div>
    <div>
        <label class="vt-label" for="cor">Cor</label>
        <input id="cor" name="cor" class="vt-input" value="{{ old('cor', $animal->cor ?? '') }}">
    </div>
    <div>
        <label class="vt-label" for="porte">Porte</label>
        <select id="porte" name="porte" class="vt-input" required>
            <option value="">Selecione</option>
            <option value="pequeno" @selected($selectedPorte === 'pequeno')>Pequeno</option>
            <option value="medio" @selected($selectedPorte === 'medio')>Medio</option>
            <option value="grande" @selected($selectedPorte === 'grande')>Grande</option>
        </select>
    </div>
</div>
