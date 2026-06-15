<?php

use App\Http\Controllers\AdminClinicaController;
use App\Http\Controllers\AnimalController;
use App\Http\Controllers\AtendimentoController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ClinicProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VacinaController;
use App\Http\Controllers\VeterinarioAtendimentoController;
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
Route::get('/cadastro-clinica', [AuthController::class, 'showClinicRegister'])->name('clinicas.register');
Route::post('/cadastro-clinica', [AuthController::class, 'registerClinic'])->name('clinicas.register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::get('/clinicas', [AdminClinicaController::class, 'index'])->name('clinicas.index');
        Route::post('/clinicas/{clinica}/aprovar', [AdminClinicaController::class, 'approve'])->name('clinicas.approve');
        Route::post('/clinicas/{clinica}/rejeitar', [AdminClinicaController::class, 'reject'])->name('clinicas.reject');
    });

    Route::middleware('role:clinic')->group(function () {
        Route::get('/minha-clinica', [ClinicProfileController::class, 'show'])->name('clinicas.profile');
        Route::match(['post', 'put'], '/minha-clinica', [ClinicProfileController::class, 'update'])->name('clinicas.profile.update');
    });

    Route::middleware('role:vet')->prefix('vet')->name('vet.')->group(function () {
        Route::get('/atendimentos', [VeterinarioAtendimentoController::class, 'index'])->name('atendimentos.index');
        Route::post('/disponibilidade', [VeterinarioAtendimentoController::class, 'toggleAvailability'])->name('disponibilidade');
    });

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

    Route::get('/atendimentos', [AtendimentoController::class, 'index'])->name('atendimentos.index');
    Route::get('/atendimentos/create', [AtendimentoController::class, 'create'])->name('atendimentos.create');
    Route::post('/atendimentos', [AtendimentoController::class, 'store'])->name('atendimentos.store');
    Route::get('/atendimentos/{atendimento}', [AtendimentoController::class, 'show'])->name('atendimentos.show');
    Route::post('/atendimentos/{atendimento}/aceitar', [AtendimentoController::class, 'accept'])->name('atendimentos.accept');
    Route::post('/atendimentos/{atendimento}/recusar', [AtendimentoController::class, 'refuse'])->name('atendimentos.refuse');
    Route::post('/atendimentos/{atendimento}/mensagens', [AtendimentoController::class, 'message'])->name('atendimentos.messages');
    Route::post('/atendimentos/{atendimento}/finalizar', [AtendimentoController::class, 'finish'])->name('atendimentos.finish');
    Route::post('/atendimentos/{atendimento}/cancelar', [AtendimentoController::class, 'cancel'])->name('atendimentos.cancel');
    Route::delete('/atendimentos/{atendimento}', [AtendimentoController::class, 'destroy'])->name('atendimentos.destroy');

    Route::get('/clinicas', [ClinicaController::class, 'index'])->name('clinicas.index');
    Route::get('/clinicas/busca', [ClinicaController::class, 'buscar'])->name('clinicas.buscar');
    Route::get('/clinicas/{id}', [ClinicaController::class, 'show'])->name('clinicas.show');

    Route::get('/consultas', fn () => redirect()->route('atendimentos.index'))->name('consultas.index');
    Route::get('/consultas/create', fn () => redirect()->route('atendimentos.create'))->name('consultas.create');
    Route::post('/consultas', fn () => redirect()->route('atendimentos.create'))->name('consultas.store');
    Route::get('/consultas/{id}', fn () => redirect()->route('atendimentos.index'))->name('consultas.show');
    Route::delete('/consultas/{id}', fn () => redirect()->route('atendimentos.index'))->name('consultas.destroy');

    Route::get('/telemedicina', fn () => redirect()->route('atendimentos.index'))->name('telemedicina.index');
    Route::post('/telemedicina', fn () => redirect()->route('atendimentos.create'))->name('telemedicina.store');
    Route::get('/telemedicina/sala/{id}', fn () => redirect()->route('atendimentos.index'))->name('telemedicina.sala');

    Route::get('/chat', [ChatController::class, 'index'])->name('chat');
    Route::post('/chat', [ChatController::class, 'store'])->name('chat.send');
});
