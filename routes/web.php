<?php

use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\ConvenioController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

// Rotas auth
Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');

//Rotas Agenda
Route::get('/load-events', [EventController::class, 'loadEvents'])->name('routeLoadEvents');
Route::put('/event-update', [EventController::class, 'update'])->name('event.update');



// Rotas Login
Route::get('/', [LoginController::class, 'index'])->name('auth.login');

// Rota para o profissional (medico)
Route::get('/profissional', [MedicoController::class, 'index'])->name('medicos.index');

// Rota para o formulário de cadastro de médico
Route::get('/form_medico', [MedicoController::class, 'index'])->name('medico.index');

// Rota para armazenar um novo médico
Route::post('/form_medico', [MedicoController::class, 'store'])->name('medico.store');

// Rotas da Tela Pacientes

// Rota para listar convênios
Route::get('/convenio', [PersonController::class, 'ListarConvenio'])->name('convenio.listar');
// Rota para atualizar os dados de um paciente
Route::post('/update-paciente', [PersonController::class, 'update'])->name('paciente.update');
Route::post('/convenios', 'PersonController@ListarConvenio');
Route::get('/pacientes', [PersonController::class, 'index'])->name('pacientes.index');
// Rota para o formulário de cadastro de paciente
Route::get('/form_paciente', [PersonController::class, 'index'])->name('paciente.index');
// Rota para armazenar um novo paciente
Route::post('/form_paciente', [PersonController::class, 'store'])->name('paciente.store');

// Rotas da Tela Configurações Clinica
Route::get('/clinica', [ClinicaController::class, 'index'])->name('clinica.index');
Route::post('/clinica', [ClinicaController::class, 'store'])->name('clinica.store');
Route::patch('/clinica', [ClinicaController::class, 'update'])->name('clinica.update');

// Rotas da Tela Configurações Procedimentos
Route::resource('procedimentos', ProcedimentoController::class);

Route::get('/procedimentos', [ProcedimentoController::class, 'index'])->name('procedimentos.index');
Route::get('/procedimentos/create', [ProcedimentoController::class, 'create'])->name('procedimentos.create');
Route::post('/procedimentos', [ProcedimentoController::class, 'store'])->name('procedimentos.store');

Route::get('/procedimentos/edit', [ConvenioController::class, 'edit'])->name('convenios.edit');
Route::put('/procedimentos/{pk_cod_proc}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/procedimentos', [ConvenioController::class, 'destroy'])->name('convenios.destroy');

//Rotas da Tela Configurações Convênios
Route::resource('convenios', ConvenioController::class);

Route::get('/convenios', [ConvenioController::class, 'index'])->name('convenios.index');
Route::get('/convenios/create', [ConvenioController::class, 'create'])->name('convenios.create');
Route::post('/convenios', [ConvenioController::class, 'store'])->name('convenios.store');

Route::get('/convenios/edit', [ConvenioController::class, 'edit'])->name('convenios.edit');
Route::put('/convenios/{pk_id_conv}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/convenios/{pk_id_conv}', [ConvenioController::class, 'destroy'])->name('convenios.destroy');



// Rota para o formulário de cadastro de paciente
Route::get('/form_paciente', function () {
    return view('pacientes/form_paciente');
});
Route::get('/form_medico', function () {
    return view('medicos/form_medico');
});