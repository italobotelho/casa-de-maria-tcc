<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Convenio;

class PersonController extends Controller
{
    public function ListarConvenio() // Nome do método corrigido
    {
        $convenios = Convenio::all(); // Recupera todos os convênios
        return response()->json($convenios); // Retorna os dados como JSON
    }

    public function index(){
        //Seleciona todos os "pacientes" e armazena no array
        $pacientes = Paciente::all();
        return view('pacientes.index',['pacientes' => $pacientes ]);
    }

    public function store(Request $request)
    {
        // Calcula a idade com base na data de nascimento fornecida
        $birthDate = new \DateTime($request->input('data_nasci_paci'));
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y;

        // Regras de validação básicas
        $rules = [
            'nome_paci' => 'required|string|max:54',
            'data_nasci_paci' => 'required|date',
            'telefone_paci' => 'required|string|max:12',
            'email_paci' => 'required|email',
            'carteira_convenio_paci' => 'required|string|max:20',
            'nome_cidade' => 'required|string|max:100',
            'fk_convenio_paci' => 'required|string',
            'data_obito_paci' => 'nullable|date', // campo opcional
            'cpf_paci' => 'required|string|max:12'
        ];

        // Se a idade for menor que 18 anos, adiciona as regras para o responsável
        if ($age < 18) {
            $rules['cpf_responsavel_paci'] = 'required|string|max:11';
            $rules['responsavel_paci'] = 'required|string|max:54';
        }

        // Aplica a validação com as regras definidas
        $request->validate($rules);

        // Cria um novo paciente e atribui os dados do request
        $paciente = new Paciente();
        $paciente->nome_paci = $request->nome_paci;
        $paciente->data_nasci_paci = $request->data_nasci_paci;
        $paciente->telefone_paci = $request->telefone_paci;
        $paciente->email_paci = $request->email_paci;
        $paciente->carteira_convenio_paci = $request->carteira_convenio_paci;
        $paciente->fk_convenio_paci = $request->fk_convenio_paci;
        $paciente->nome_cidade = $request->nome_cidade;
        $paciente->data_obito_paci = $request->data_obito_paci; // campo opcional
        $paciente->cpf_paci = $request->cpf_paci;

        // Se a idade for menor de 18 anos, salva os dados do responsável
        if ($age < 18) {
            $paciente->cpf_responsavel_paci = $request->cpf_responsavel_paci;
            $paciente->responsavel_paci = $request->responsavel_paci;
        }

        // Salva o paciente no banco de dados
        $paciente->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('paciente.store')->with('success', 'Paciente cadastrado com sucesso!');
    }
}
