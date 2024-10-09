<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PersonController;
use Illuminate\Support\Facades\Route;

// Rota para autenticação do usuário via método POST
Route::post('/', [LoginController::class,'auth'])->name('auth.user');
Route::get('/', [LoginController::class, 'index'])->name('login.page');

// Rota para a página inicial do menu, protegida por middleware de autenticação
Route::get('/menu', function () {
    return view('Menu/menu'); // Substitua isso pela lógica correta para a sua página inicial
})->middleware('auth');

// Rota para o layout
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

