<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\ConvenioController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/layout', function () {
    return view('Layout/layout');
});

// Rotas da Tela Menu

// Rotas da Tela Menu

Route::get('/agenda', function () {
    return view('Menu/agenda');
});

Route::get('/consulta', function () {
    return view('Menu/consulta');
});

// Rota para a lista de pacientes
Route::get('/pacientes', [PersonController::class, 'index'])->name('pacientes.index');

// Rota para o profissional (medico)
Route::get('/profissional', [MedicoController::class, 'index'])->name('medicos.index');

// Rota para o formulário de cadastro de paciente
Route::get('/form_paciente', function () {
    return view('Cadastros/form_paciente');
});

// Rota para armazenar um novo paciente
Route::post('/form_paciente', [PersonController::class, 'store'])->name('paciente.store');

// Rota para listar convênios
Route::get('/convenio', [PersonController::class, 'ListarConvenio'])->name('convenio.listar');


// Rota para o formulário de cadastro de médico
Route::get('/form_medico', function () {
    return view('Cadastros/form_medico');
});

// Rota para armazenar um novo médico
Route::post('/form_medico', [MedicoController::class, 'store'])->name('medico.store');
Route::get('menu/pacientes', [PersonController::class, 'index'])->name('pacientes.index');

// Rotas da Tela Configurações Gerais

Route::get('/gerais', 'App\Http\Controllers\ClinicaController@index')->name('clinica.index');
Route::post('/gerais', 'App\Http\Controllers\ClinicaController@store')->name('clinica.store');
Route::patch('/gerais', 'App\Http\Controllers\ClinicaController@update')->name('clinica.update');

// Rotas da Tela Pacientes

// Rota para atualizar os dados de um paciente
Route::post('/update-paciente', [PersonController::class, 'update'])->name('paciente.update');
Route::post('/convenios', 'PersonController@ListarConvenio');


Route::get('Menu/pacientes', [PersonController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes', [PersonController::class, 'index'])->name('pacientes.index');

Auth::routes();
// Rotas da Tela Configurações Procedimentos
Route::get('/procedimentos', [ProcedimentoController::class, 'index'])->name('procedimentos.index');
Route::get('/procedimentos/create', [ProcedimentoController::class, 'create'])->name('procedimentos.create');
Route::get('/procedimentos/{pk_cod_proc}', [ProcedimentoController::class, 'show'])->name('procedimentos.show');
Route::post('/procedimentos', [ProcedimentoController::class, 'store'])->name('procedimentos.store');


//Rotas da Tela Configurações Convenios

Route::get('/convenios', [ConvenioController::class, 'index'])->name('convenios.index');
Route::get('/convenios/create', [ConvenioController::class, 'create'])->name('convenios.create');
Route::post('/convenios', [ConvenioController::class, 'store'])->name('convenios.store');

Route::get('/convenios/{pk_id_conv}/edit', [ConvenioController::class, 'edit'])->name('convenios.edit');
Route::patch('/convenios/{pk_id_conv}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/convenios/{pk_id_conv}', [ConvenioController::class, 'destroy'])->name('convenios.destroy');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
