<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\TelemedicinaController;

/*
|--------------------------------------------------------------------------
| ROTAS PÚBLICAS
|--------------------------------------------------------------------------
*/

// Página inicial
Route::get('/', function () {
    return view('site');
})->name('home');

// Página de pagamento
Route::get('/pagamento', function () {
    return view('pagamento');
})->name('pagamento');

// Sobre
Route::view('/sobre', 'sobre')->name('sobre');

// Contato
Route::view('/contato', 'contato')->name('contato');

// Página visitantes
Route::view('/visitantes', 'visitantes')->name('visitantes');

// Página alternativa
Route::get('/vettech', function () {
    return view('visitantes.index');
});

// =====================================
// CLÍNICAS E TELEMEDICINA
// =====================================

// Clínicas
Route::get('/clinicas', [ClinicaController::class, 'index'])
    ->name('clinicas.buscar');

// Telemedicina
Route::get('/telemedicina', [TelemedicinaController::class, 'index'])
    ->name('telemedicina.index');

// =====================================
// CONTATO
// =====================================

Route::post('/contato/enviar', function (Request $request) {

    // TODO: lógica de envio de contato

    return redirect()
        ->back()
        ->with('success', 'Mensagem enviada com sucesso!');

})->name('contato.enviar');

/*
|--------------------------------------------------------------------------
| AUTENTICAÇÃO
|--------------------------------------------------------------------------
*/

// =====================
// LOGIN
// =====================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login.post');

// =====================
// CADASTRO
// =====================

Route::get('/cadastro', function () {
    return view('cadastro');
})->name('cadastro');

Route::post('/cadastro', [AuthController::class, 'register'])
    ->name('cadastro.post');

// =====================
// LOGOUT
// =====================

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout');

/*
|--------------------------------------------------------------------------
| ROTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/

Route::middleware(['auth.custom'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    /*
    |--------------------------------------------------------------------------
    | ANIMAIS / PETS
    |--------------------------------------------------------------------------
    */

    // Novo pet
    Route::get('/novo-pet', [AnimalController::class, 'create'])
        ->name('animais.create');

    // Salvar pet
    Route::post('/novo-pet', [AnimalController::class, 'store'])
        ->name('animais.store');

    // Listar pets
    Route::get('/meus-animais', [AnimalController::class, 'index'])
        ->name('animais.index');

    // Editar pet
    Route::get('/animais/{id}/edit', [AnimalController::class, 'edit'])
        ->name('animais.edit');

    // Atualizar pet
    Route::put('/animais/{id}', [AnimalController::class, 'update'])
        ->name('animais.update');

    // Excluir pet
    Route::delete('/animais/{id}', [AnimalController::class, 'destroy'])
        ->name('animais.destroy');

    /*
    |--------------------------------------------------------------------------
    | ATENDIMENTOS
    |--------------------------------------------------------------------------
    */

    // Tela atendimentos
    Route::get('/atendimentos', [AtendimentoController::class, 'create'])
        ->name('atendimentos.index');

    // Criar atendimento
    Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])
        ->name('atendimentos.create');

    // Salvar atendimento
    Route::post('/atendimentos', [AtendimentoController::class, 'store'])
        ->name('atendimentos.store');

    // Atualizar status
    Route::put('/atendimentos/{id}/status', [AtendimentoController::class, 'updateStatus'])
        ->name('atendimentos.status');

    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    // Tela chat
    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat');

    // Enviar mensagem
    Route::post('/chat', [ChatController::class, 'store'])
        ->name('chat.send');

});
