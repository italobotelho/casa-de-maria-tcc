<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // Método para exibir a página de login
    public function index()
    {
        return view('Login/login');
    }

    public function auth(Request $request)
{
    // Validação dos dados do formulário
    $this->validate($request, [
        'user' => 'required|string|max:255',
        'senha' => 'required',
    ], [
        'user.required' => 'O usuário é obrigatório',
        'senha.required' => 'A Senha é obrigatória'
    ]);

    // Tentativa de autenticação
    if (Auth::attempt(['user' => $request->user, 'password' => $request->senha])) {
        // Redireciona para a página desejada após o login bem-sucedido
        return redirect()->intended('menu');
    } else {
        // Redireciona de volta com mensagem de erro
        return redirect()->back()->withInput($request->only('user'))->withErrors([
            'senha' => 'Usuário ou senha inválida.',
        ]);
    }
}
}
