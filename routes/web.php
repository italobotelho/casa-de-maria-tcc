<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\MedicoController;
use App\Http\Controllers\PersonController;
use App\Http\Controllers\ClinicaController;
use App\Http\Controllers\ProcedimentoController;
use App\Http\Controllers\ConvenioController;
use Illuminate\Support\Facades\Route;

// Rota para autenticação do usuário via método POST
Route::post('/', [LoginController::class,'auth'])->name('auth.user');
Route::get('/', [LoginController::class, 'index'])->name('login.page');

Route::get('/menu', function () {
    return view('Menu/menu'); // Substitua isso pela lógica correta para a sua página inicial
})->middleware('auth');


Route::get('/layout', function () {
    return view('Layout/layout');
});

// Rotas da Tela Menu

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

Route::get('/form_paciente', function () {
    return view('Cadastros/form_paciente');
});

Route::post('/form_paciente', [PersonController::class, 'store'])->name('paciente.store');
Route::get('/convenio', [PersonController::class, 'ListarConvenio'])->name('convenio.listar');



Route::get('/form_medico', function () {
    return view('Cadastros/form_medico');
});

Route::get('profissional', [MedicoController::class, 'index'])->name('medicos.index');
Route::post('/form_medico', [MedicoController::class, 'store'])->name('medico.store');
<<<<<<< HEAD
Route::get('menu/pacientes', [PersonController::class, 'index'])->name('pacientes.index');

// Rotas da Tela Configurações Gerais

Route::get('/gerais', 'App\Http\Controllers\ClinicaController@index')->name('clinica.index');
Route::post('/gerais', 'App\Http\Controllers\ClinicaController@store')->name('clinica.store');
Route::patch('/gerais', 'App\Http\Controllers\ClinicaController@update')->name('clinica.update');

// Rotas da Tela Configurações Procedimentos
=======
Route::get('Menu/pacientes', [PersonController::class, 'index'])->name('pacientes.index');
Route::get('/pacientes', [PersonController::class, 'index'])->name('pacientes.index');
>>>>>>> tela-busca


Route::get('/procedimentos', [ProcedimentoController::class, 'index'])->name('procedimentos.index');
Route::get('/procedimentos/create', [ProcedimentoController::class, 'create'])->name('procedimentos.create');
Route::get('/procedimentos/{pk_cod_proc}', 'ProcedimentoController@show');
Route::post('/procedimentos', [ProcedimentoController::class, 'store'])->name('procedimentos.store');


//Rotas da Tela Configurações Convenios

Route::get('/convenios', [ConvenioController::class, 'index'])->name('convenios.index');
Route::get('/convenios/create', [ConvenioController::class, 'create'])->name('convenios.create');
Route::post('/convenios', [ConvenioController::class, 'store'])->name('convenios.store');

Route::get('/convenios/{pk_id_conv}/edit', [ConvenioController::class, 'edit'])->name('convenios.edit');
Route::put('/convenios/{pk_id_conv}', [ConvenioController::class, 'update'])->name('convenios.update');
Route::delete('/convenios/{pk_id_conv}', [ConvenioController::class, 'destroy'])->name('convenios.destroy');