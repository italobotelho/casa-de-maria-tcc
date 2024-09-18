<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clinica;

class ConfiguracoesController extends Controller
{
    public function index()
    {
        $clinica = Clinica::first(); // retrieve the first clinica record
        return view('configuracoes.index', compact('clinica'));
    }

    public function store(Request $request)
    {          
        // Validate the request data
        $request->validate([
            'nome_clin' => 'required|string',
            'cnpj_clin' => 'required|integer',
            'descricao_clin' => 'required|string',
            'telefone_clin' => 'required|numeric',
            'email_aten_clin' => 'required|email',
            'email_resp_clin' => 'required|email',
            'cep_clin' => 'required|string',
            'rua_clin' => 'required|string',
            'numero_clin' => 'required|numeric',
            'bairro_clin' => 'required|string',
            'complemento_clin' => 'required|string',
            'cidade_clin' => 'required|string',
            'uf_clin' => 'required|string',
            'cod_ibge_clin' => 'required|numeric',
        ]);

        // Check if a record with the same cnpj_clin already exists
        $clinica = Clinica::where('cnpj_clin', $request->input('cnpj_clin'))->first();

        if ($clinica) {
            // Update the existing record
            $clinica->fill($request->all());
            $clinica->save();
            return redirect()->route('configuracoes.index')->with('success', 'Dados da clínica atualizados com sucesso!');
        } else {
            // Create a new instance of the model
            $clinica = new Clinica();
            $clinica->cnpj_clin = $request->input('cnpj_clin');
            $clinica->nome_clin = $request->input('nome_clin');
            $clinica->descricao_clin = $request->input('descricao_clin');
            $clinica->telefone_clin = $request->input('telefone_clin');
            $clinica->email_aten_clin = $request->input('email_aten_clin');
            $clinica->email_resp_clin = $request->input('email_resp_clin');
            $clinica->cep_clin = $request->input('cep_clin');
            $clinica->rua_clin = $request->input('rua_clin');
            $clinica->numero_clin = $request->input('numero_clin');
            $clinica->bairro_clin = $request->input('bairro_clin');
            $clinica->complemento_clin = $request->input('complemento_clin');
            $clinica->cidade_clin = $request->input('cidade_clin');
            $clinica->uf_clin = $request->input('uf_clin');
            $clinica->cod_ibge_clin = $request->input('cod_ibge_clin');

            // Save the model
            $clinica->save();

            // Redirect to the success page
            return redirect()->route('configuracoes.index')->with('success', 'Dados da clínica cadastrados com sucesso!');
        }
    }   

    public function update(Request $request)
    {
        $clinica = Clinica::first(); // retrieve the first clinica record
        $clinica->fill($request->all()); // fill the model with the input data
        $clinica->save(); // save the changes
        return redirect()->back()->with('success', 'Dados da clínica atualizados com sucesso!');
    }
}
