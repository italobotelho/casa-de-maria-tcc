<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ConfiguracoesController;
use App\Http\Controllers\ProcedimentoController;
use Illuminate\Support\Facades\Route;

// Rota para autenticação do usuário via método POST
Route::post('/', [LoginController::class,'auth'])->name('auth.user');
Route::get('/', [LoginController::class, 'index'])->name('login.page');

Route::get('/menu', function () {
    return view('Menu/menu'); // Substitua isso pela lógica correta para a sua página inicial
})->middleware('auth');

Route::get('/pacientes', function () {
    return view('Pacientes/pacientes');
});

Route::get('/layout', function () {
    return view('Layout/layout');
});

Route::get('/config-gerais', function () {
    return view('Configurações/gerais');
});

Route::get('/config-convenios', function () {
    return view('Configurações/convenios');
});
Route::get('/agenda', function () {
    return view('Menu/agenda');
});

Route::get('/consulta', function () {
    return view('Menu/consulta');
});

Route::get('/pacientes', function () {
    return view('Menu/pacientes');
});

Route::get('/profissional', function () {
    return view('Menu/profissional');
});

// Rotas da Tela Configurações Gerais

Route::get('/config-gerais', 'App\Http\Controllers\ConfiguracoesController@index')->name('config-gerais.store');
Route::post('/config-gerais', 'App\Http\Controllers\ConfiguracoesController@store')->name('config-gerais.store');
Route::patch('/config-gerais', 'App\Http\Controllers\ConfiguracoesController@update')->name('config-gerais.store');

// Rotas da Tela Configurações Procedimentos


Route::get('/procedimentos/create', [ProcedimentoController::class, 'create'])->name('procedimentos.create');
Route::get('/procedimentos/{pk_cod_proc}', 'ProcedimentoController@show');
Route::post('/procedimentos', [ProcedimentoController::class, 'store'])->name('procedimentos.store');
Route::get('/procedimentos', [ProcedimentoController::class, 'index'])->name('procedimentos.index');


