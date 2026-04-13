<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;

// --------------------
// Página inicial
// --------------------
Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/pagamento', function () {
    return view('pagamento');
})->name('pagamento');

// --------------------
// Autenticação (LIBERADO)
// --------------------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/clinicas', function () {
    return view('clinicas');
})->name('clinicas.buscar');

// Cadastro
Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'register'])->name('cadastro.post');

use Illuminate\Http\Request;

Route::post('/contato/enviar', function (Request $request) {
    // lógica do envio (por enquanto pode deixar simples)
    return redirect()->back()->with('success', 'Mensagem enviada!');
})->name('contato.enviar');

// --------------------
// Páginas públicas (LIBERADO)
// --------------------
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');
Route::view('/visitantes', 'visitantes')->name('visitantes');



Route::put('/atendimentos/{id}/status', [AtendimentoController::class, 'updateStatus'])
    ->name('atendimentos.status');

// ==========================
// 🔒 ROTAS PROTEGIDAS
// ==========================
Route::middleware(['auth.custom'])->group(function () {

    // --------------------
    // Animais
    // --------------------
    Route::get('/novo-pet', [AnimalController::class, 'create'])->name('animais.create');
    Route::post('/novo-pet', [AnimalController::class, 'store'])->name('animais.store');
    Route::get('/meus-animais', [AnimalController::class, 'index'])->name('animais.index');

    Route::get('/animais/{id}/edit', [AnimalController::class, 'edit'])->name('animais.edit');
    Route::put('/animais/{id}', [AnimalController::class, 'update'])->name('animais.update');
    Route::delete('/animais/{id}', [AnimalController::class, 'destroy'])->name('animais.destroy');

    // --------------------
    // Atendimentos
    // --------------------
    Route::get('/atendimentos', [AtendimentoController::class, 'create'])->name('atendimentos.index');
    Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])->name('atendimentos.create');
    Route::post('/atendimentos', [AtendimentoController::class, 'store'])->name('atendimentos.store');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.send');
});

Route::get('/vettech', function () {
    return view('visitantes.index');
});
