<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\AuthController;

// --------------------
// Página inicial
// --------------------
Route::get('/', function () {
    return view('home');
})->name('home');

// --------------------
// Autenticação
// --------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Cadastro (AGORA CERTO)
Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'register'])->name('cadastro.post');

// --------------------
// Páginas estáticas
// --------------------
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');

// --------------------
// Animais
// --------------------
Route::get('/novo-pet', [AnimalController::class, 'create'])->name('animais.create');
Route::post('/novo-pet', [AnimalController::class, 'store'])->name('animais.store');
Route::get('/meus-animais', [AnimalController::class, 'index'])->name('animais.index');

// --------------------
// Atendimentos
// --------------------
Route::get('/atendimentos', [AtendimentoController::class, 'create'])->name('atendimentos.index');
Route::post('/atendimentos', [AtendimentoController::class, 'store'])->name('atendimentos.store');
