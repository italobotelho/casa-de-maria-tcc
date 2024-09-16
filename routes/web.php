<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\PersonController;
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





