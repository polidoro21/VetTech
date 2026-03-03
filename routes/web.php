<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;

// Página inicial
Route::get('/', function () {
    return view('home');
})->name('home');

// Páginas estáticas
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');

// Cadastro de animais
Route::get('/cadastro', [AnimalController::class, 'create'])->name('cadastro');
Route::post('/cadastro', [AnimalController::class, 'store'])->name('cadastro.store');

// Cadastro + lista de atendimentos
Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])
    ->name('atendimentos.create');

Route::post('/atendimentos', [AtendimentoController::class, 'store'])
    ->name('atendimentos.store');
