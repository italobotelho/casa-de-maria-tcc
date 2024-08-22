<?php

use App\Http\Controllers\LoginController;
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

Route::get('/login2', function () {
    return view('Login/login2');
});