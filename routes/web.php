<?php

use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TelemedicinaController;
use App\Http\Controllers\VacinaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => view('site'))->name('home');

Route::view('/pagamento', 'pagamento')->name('pagamento');
Route::view('/sobre', 'sobre')->name('sobre');
Route::view('/contato', 'contato')->name('contato');
Route::view('/visitantes', 'visitantes')->name('visitantes');
Route::view('/vettech', 'visitantes')->name('vettech');

Route::post('/contato/enviar', function (Request $request) {
    return redirect()
        ->back()
        ->with('success', 'Mensagem enviada com sucesso!');
})->name('contato.enviar');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/cadastro', fn () => view('cadastro'))->name('cadastro');
Route::post('/cadastro', [AuthController::class, 'register'])->name('cadastro.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/meus-animais', [AnimalController::class, 'index'])->name('animais.index');
    Route::get('/novo-pet', [AnimalController::class, 'create'])->name('animais.create');
    Route::post('/novo-pet', [AnimalController::class, 'store'])->name('animais.store');
    Route::get('/animais/{id}', [AnimalController::class, 'show'])->name('animais.show');
    Route::get('/animais/{id}/edit', [AnimalController::class, 'edit'])->name('animais.edit');
    Route::put('/animais/{id}', [AnimalController::class, 'update'])->name('animais.update');
    Route::delete('/animais/{id}', [AnimalController::class, 'destroy'])->name('animais.destroy');

    Route::get('/carteira-vacina', [VacinaController::class, 'index'])->name('vacinas.index');
    Route::post('/vacinas', [VacinaController::class, 'store'])->name('vacinas.store');
    Route::delete('/vacinas/{id}', [VacinaController::class, 'destroy'])->name('vacinas.destroy');

    Route::get('/consultas', [ConsultaController::class, 'index'])->name('consultas.index');
    Route::get('/consultas/create', [ConsultaController::class, 'create'])->name('consultas.create');
    Route::post('/consultas', [ConsultaController::class, 'store'])->name('consultas.store');
    Route::get('/consultas/{id}', [ConsultaController::class, 'show'])->name('consultas.show');
    Route::delete('/consultas/{id}', [ConsultaController::class, 'destroy'])->name('consultas.destroy');

    Route::get('/atendimentos', [AtendimentoController::class, 'index'])->name('atendimentos.index');
    Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])->name('atendimentos.create');
    Route::post('/atendimentos', [AtendimentoController::class, 'store'])->name('atendimentos.store');
    Route::put('/atendimentos/{id}/status', [AtendimentoController::class, 'updateStatus'])->name('atendimentos.status');
    Route::delete('/atendimentos/{id}', [AtendimentoController::class, 'destroy'])->name('atendimentos.destroy');

    Route::get('/clinicas', [ClinicaController::class, 'index'])->name('clinicas.index');
    Route::get('/clinicas/busca', [ClinicaController::class, 'buscar'])->name('clinicas.buscar');
    Route::get('/clinicas/{id}', [ClinicaController::class, 'show'])->name('clinicas.show');

    Route::get('/telemedicina', [TelemedicinaController::class, 'index'])->name('telemedicina.index');
    Route::post('/telemedicina', [TelemedicinaController::class, 'store'])->name('telemedicina.store');
    Route::get('/telemedicina/sala/{id}', [TelemedicinaController::class, 'sala'])->name('telemedicina.sala');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.send');
});
