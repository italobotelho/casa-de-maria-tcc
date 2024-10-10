<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    return view('auth/login');
});

Route::get('/layout', function () {
    return view('Layout/layout');
});

// Rotas para as diferentes páginas do menu
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

// Rota para atualizar os dados de um paciente
Route::post('/update-paciente', [PersonController::class, 'update'])->name('paciente.update');
Route::post('/convenios', 'PersonController@ListarConvenio');


Route::get('Menu/pacientes', [PersonController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes', [PersonController::class, 'index'])->name('pacientes.index');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
