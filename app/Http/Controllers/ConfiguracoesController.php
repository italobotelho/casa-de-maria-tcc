<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfiguracoesController extends Controller
{
    public function index()
    {
        $clinica = Clinica::first(); // retrieve the first clinica record
        return view('gerais', compact('clinica'));
    }

    public function update(Request $request)
    {
        $clinica = Clinica::first(); // retrieve the first clinica record
        $clinica->nome_clin = $request->input('nome_clin');
        $clinica->pk_cnpj = $request->input('pk_cnpj');
        $clinica->email_aten_clin = $request->input('email_aten_clin');
        $clinica->numero_clin = $request->input('numero_clin');
        $clinica->rua_clin = $request->input('rua_clin');
        $clinica->telefone_clin = $request->input('telefone_clin');
        $clinica->email_resp_clin = $request->input('email_resp_clin');
        $clinica->cidade_clin = $request->input('cidade_clin');
        $clinica->descriçõ_clin = $request->input('descriçõ_clin');
        $clinica->save(); // save the changes
        return redirect()->back()->with('success', 'Dados da clínica atualizados com sucesso!');
    }

}
