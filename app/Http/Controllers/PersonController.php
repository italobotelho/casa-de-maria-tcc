<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Convenio;

class PersonController extends Controller
{
    public function create()
    {
        // Fetch all convenios to populate the select field
        $convenios = Convenio::all();
        return view('create-paciente', compact('convenios'));
    }

    public function store(Request $request)
    {
        // Validate data
        $request->validate([
            'nome_paci' => 'required|string|max:54',
            'data_nasci_paci' => 'required|date',
            'cpf_responsavel_paci' => 'required|string|max:11',
            'telefone_paci' => 'required|string|max:12',
            'email_paci' => 'required|email',
            'carteira_convenio_paci' => 'required|string|max:20',
            'nome_cidade' => 'required|string|max:100',
            'fk_convenio_paci' => 'required|integer',
        ]);

        // Create a new patient
        $paciente = new Paciente();
        $paciente->nome_paci = $request->nome_paci;
        $paciente->data_nasci_paci = $request->data_nasci_paci;
        $paciente->cpf_responsavel_paci = $request->cpf_responsavel_paci;
        $paciente->telefone_paci = $request->telefone_paci;
        $paciente->email_paci = $request->email_paci;
        $paciente->carteira_convenio_paci = $request->carteira_convenio_paci;
    }
}