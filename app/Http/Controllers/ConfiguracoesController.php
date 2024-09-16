<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinica;

class ConfiguracoesController extends Controller
{
    public function index()
    {
        $clinica = Clinica::first(); // retrieve the first clinica record
        return view('Configurações/gerais', compact('clinica'));
    }

    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'required|integer',
            'descricao' => 'required|string',
            'telefone' => 'required|numeric',
            'email_aten' => 'required|email',
            'email_resp' => 'required|email',
            'cep' => 'required|string',
            'rua' => 'required|string',
            'numero' => 'required|numeric',
            'bairro' => 'required|string',
            'complemento' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|string',
            'cod_ibge' => 'required|numeric',
        ]);

        // Create a new instance of the model
        $clinica = new Clinica();

        // Fill the model with the request data
        $clinica->fill($request->all());

        // Save the model
        $clinica->save();

        // Redirect to the success page
        return redirect()->route('config-gerais.index');
    }

    public function update(Request $request)
    {
        $request->validate([
            'nome' => 'required|string',
            'cnpj' => 'required|integer',
            'descricao' => 'required|string',
            'telefone' => 'required|numeric',
            'email_aten' => 'required|email',
            'email_resp' => 'required|email',
            'cep' => 'required|string',
            'rua' => 'required|string',
            'numero' => 'required|numeric',
            'bairro' => 'required|string',
            'complemento' => 'required|string',
            'cidade' => 'required|string',
            'uf' => 'required|string',
            'cod_ibge' => 'required|numeric',
        ]);

        $clinica = Clinica::first(); // retrieve the first clinica record
        $clinica->fill($request->all()); // fill the model with the input data
        $clinica->save(); // save the changes
        return redirect()->back()->with('success', 'Dados da clínica atualizados com sucesso!');
    }
}
