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

    // LISTAR PETS
    Route::get('/meus-animais', [AnimalController::class, 'index'])
        ->name('animais.index');

    // NOVO PET
    Route::get('/novo-pet', [AnimalController::class, 'create'])
        ->name('animais.create');

    // SALVAR PET
    Route::post('/novo-pet', [AnimalController::class, 'store'])
        ->name('animais.store');

    // EDITAR PET
    Route::get('/animais/{id}/edit', [AnimalController::class, 'edit'])
        ->name('animais.edit');

    // ATUALIZAR PET
    Route::put('/animais/{id}', [AnimalController::class, 'update'])
        ->name('animais.update');

    // EXCLUIR PET
    Route::delete('/animais/{id}', [AnimalController::class, 'destroy'])
        ->name('animais.destroy');

    /*
    |--------------------------------------------------------------------------
    | CARTEIRA DE VACINA
    |--------------------------------------------------------------------------
    */

    // TELA CARTEIRA
    Route::get('/carteira-vacina', [VacinaController::class, 'index'])
        ->name('vacinas.index');

    // NOVA VACINA
    Route::post('/vacinas', [VacinaController::class, 'store'])
        ->name('vacinas.store');

    // EXCLUIR VACINA
    Route::delete('/vacinas/{id}', [VacinaController::class, 'destroy'])
        ->name('vacinas.destroy');

    /*
    |--------------------------------------------------------------------------
    | CONSULTAS
    |--------------------------------------------------------------------------
    */




    Route::delete('/atendimentos/{id}', [AtendimentoController::class, 'destroy'])
    ->name('atendimentos.destroy');

    // LISTAR CONSULTAS
    Route::get('/consultas', [ConsultaController::class, 'index'])
        ->name('consultas.index');

    // NOVA CONSULTA
    Route::get('/consultas/create', [ConsultaController::class, 'create'])
        ->name('consultas.create');

    // SALVAR CONSULTA
    Route::post('/consultas', [ConsultaController::class, 'store'])
        ->name('consultas.store');

    /*
    |--------------------------------------------------------------------------
    | ATENDIMENTOS
    |--------------------------------------------------------------------------
    */

    // TELA ATENDIMENTOS
    Route::get('/atendimentos', [AtendimentoController::class, 'index'])
        ->name('atendimentos.index');

    // NOVO ATENDIMENTO
    Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])
        ->name('atendimentos.create');

    // SALVAR
    Route::post('/atendimentos', [AtendimentoController::class, 'store'])
        ->name('atendimentos.store');

    // STATUS
    Route::put('/atendimentos/{id}/status', [AtendimentoController::class, 'updateStatus'])
        ->name('atendimentos.status');

    /*
    |--------------------------------------------------------------------------
    | CHAT
    |--------------------------------------------------------------------------
    */

    // TELA CHAT
    Route::get('/chat', [ChatController::class, 'index'])
        ->name('chat');

    // ENVIAR MSG
    Route::post('/chat', [ChatController::class, 'store'])
        ->name('chat.send');

});
