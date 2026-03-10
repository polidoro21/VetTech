<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui ficam todas as rotas do projeto.
|
*/

// --------------------
// Página inicial
// --------------------
Route::get('/', function () {
    return view('home');
})->name('home');

// --------------------
// Páginas estáticas
// --------------------
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');

// --------------------
// Animais
// --------------------
Route::get('/novo-pet', [AnimalController::class, 'create'])
    ->name('animais.create');

Route::get('/meus-animais', [AnimalController::class, 'index'])
    ->name('animais.index');

// Salva o animal
Route::post('/novo-pet', [AnimalController::class, 'store'])
    ->name('animais.store');

// --------------------
// Atendimentos
// --------------------

// Mostrar formulário + lista de atendimentos
Route::get('/atendimentos', [AtendimentoController::class, 'create'])
    ->name('atendimentos.index'); // GET /atendimentos

// Salvar atendimento
Route::post('/atendimentos', [AtendimentoController::class, 'store'])
    ->name('atendimentos.store');
