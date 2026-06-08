<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\TelemedicinaController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\VacinaController;
use App\Http\Controllers\DashboardController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// HOME
Route::get('/', function () {
    return view('site');
})->name('home');

// PAGAMENTO
Route::get('/pagamento', function () {
    return view('pagamento');
})->name('pagamento');

// SOBRE
Route::view('/sobre', 'sobre')->name('sobre');

// CONTATO
Route::view('/contato', 'contato')->name('contato');

// VISITANTES
Route::view('/visitantes', 'visitantes')->name('visitantes');

// VETTECH
Route::get('/vettech', function () {
    return view('visitantes.index');
})->name('vettech');

// MEUS ANIMAIS
Route::get('/meus-animais', [AnimalController::class, 'index'])
    ->name('animais.index');

/*
|--------------------------------------------------------------------------
| CLÍNICAS E TELEMEDICINA
|--------------------------------------------------------------------------
*/

// CLÍNICAS
Route::get('/clinicas', [ClinicaController::class, 'index'])
    ->name('clinicas.index');

// BUSCA DE CLÍNICAS
Route::get('/clinicas/busca', [ClinicaController::class, 'buscar'])
    ->name('clinicas.buscar');

// TELEMEDICINA
Route::get('/telemedicina', [TelemedicinaController::class, 'index'])
    ->name('telemedicina.index');

/*
|--------------------------------------------------------------------------
| CONTATO
|--------------------------------------------------------------------------
*/

Route::post('/contato/enviar', function (Request $request) {
    return redirect()
        ->back()
        ->with('success', 'Mensagem enviada com sucesso!');
})->name('contato.enviar');

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

// LOGIN
Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// CADASTRO
Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');

Route::post('/cadastro', [AuthController::class, 'register'])
    ->name('cadastro.post');

// LOGOUT
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.custom'])->group(function () {

// ANTES (estático):
Route::get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

// DEPOIS (com controller):
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ANIMAIS / PETS
    |--------------------------------------------------------------------------
    */

    Route::get('/meus-animais', [AnimalController::class, 'index'])
        ->name('animais.index');

    Route::get('/novo-pet', [AnimalController::class, 'create'])
        ->name('animais.create');

    Route::post('/novo-pet', [AnimalController::class, 'store'])
        ->name('animais.store');

    Route::get('/animais/{id}/edit', [AnimalController::class, 'edit'])
        ->name('animais.edit');

    Route::put('/animais/{id}', [AnimalController::class, 'update'])
        ->name('animais.update');

    Route::delete('/animais/{id}', [AnimalController::class, 'destroy'])
        ->name('animais.destroy');

    /*
    |--------------------------------------------------------------------------
    | CARTEIRA DE VACINA
    |--------------------------------------------------------------------------
    */

    Route::get('/carteira-vacina', [VacinaController::class, 'index'])
        ->name('vacinas.index');

    Route::post('/vacinas', [VacinaController::class, 'store'])
        ->name('vacinas.store');

    Route::delete('/vacinas/{id}', [VacinaController::class, 'destroy'])
        ->name('vacinas.destroy');

    /*
    |--------------------------------------------------------------------------
    | CONSULTAS
    |--------------------------------------------------------------------------
    */

    Route::get('/consultas', [ConsultaController::class, 'index'])
        ->name('consultas.index');

    Route::get('/consultas/create', [ConsultaController::class, 'create'])
        ->name('consultas.create');

    Route::post('/consultas', [ConsultaController::class, 'store'])
        ->name('consultas.store');

    /*
    |--------------------------------------------------------------------------
    | ATENDIMENTOS
    |--------------------------------------------------------------------------
    */

    Route::get('/atendimentos', [AtendimentoController::class, 'index'])
        ->name('atendimentos.index');

    Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])
        ->name('atendimentos.create');

    Route::post('/atendimentos', [AtendimentoController::class, 'store'])
        ->name('atendimentos.store');

    Route::put('/atendimentos/{id}/status', [AtendimentoController::class, 'updateStatus'])
        ->name('atendimentos.status');

    Route::delete('/atendimentos/{id}', [AtendimentoController::class, 'destroy'])
        ->name('atendimentos.destroy');

    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat');

    Route::post('/chat', [ChatController::class, 'store'])
        ->name('chat.send');
});
