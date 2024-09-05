<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;

class PersonController extends Controller
{

    public function store(Request $request)
    {
        // Validação dos dados
        $request->validate([
            'nome_paci' => 'required|string|max:54',
            'data_nasci_paci' => 'required|date',
            'cpf_responsavel_paci' => 'required|string|max:11',
            'telefone_paci' => 'required|string|max:12',
            'email_paci' => 'required|email',
            'carteira_convenio_paci' => 'required|string|max:20',
            'fk_cidade' => 'required|integer',
            'fk_convenio_paci' => 'required|integer',
        ]);

        // Criação do novo paciente
        $paciente = new Paciente();
        $paciente->nome_paci = $request->nome_paci;
        $paciente->data_nasci_paci = $request->data_nasci_paci;
        $paciente->cpf_responsavel_paci = $request->cpf_responsavel_paci;
        $paciente->telefone_paci = $request->telefone_paci;
        $paciente->email_paci = $request->email_paci;
        $paciente->carteira_convenio_paci = $request->carteira_convenio_paci;
        $paciente->fk_cidade = $request->fk_cidade;
        $paciente->fk_convenio_paci = $request->fk_convenio_paci;
        $paciente->save();

        return redirect('/')->with('success', 'Paciente cadastrado com sucesso!');
    }
}
