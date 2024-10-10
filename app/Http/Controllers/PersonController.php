<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Paciente;
use App\Models\Convenio;

class PersonController extends Controller
{


    public function update(Request $request)
    {
        // Validação
        $request->validate([
            'id' => 'required|exists:paciente,pk_cod_paci',
            'nome' => 'required|string|max:54',
            'email' => 'required|email',
            'data_nasci' => 'required|date',
            'telefone' => 'required|string|max:15',
            'cpf' => 'required|string|max:14',
            'cidade' => 'required|string|max:100',
            'responsavel' => 'string|max:54',
            'cpf_responsavel' => 'string|max:14',
            'fk_convenio_paci' => 'nullable|string'

        ]);

        $paciente = Paciente::find($request->input('id'));

        if ($paciente) {
            $paciente->nome_paci = $request->input('nome');
            $paciente->data_nasci_paci = $request->input('data_nasci');
            $paciente->telefone_paci = $request->input('telefone');
            $paciente->cpf_paci = $request->input('cpf');
            $paciente->nome_cidade = $request->input('cidade');
            $paciente->responsavel_paci = $request->input('responsavel');
            $paciente->cpf_responsavel_paci = $request->input('cpf_responsavel');
            $paciente->fk_convenio_paci = $request->input('fk_convenio_paci');



            if ($paciente->save()) {
                return response()->json(['success' => true, 'message' => 'Dados do paciente atualizados com sucesso!']);
            } else {
                return response()->json(['error' => 'Erro ao atualizar paciente'], 422);
            }
        } else {
            return response()->json(['error' => 'Paciente não encontrado'], 404);
        }
    }


    public function ListarConvenio() // Nome do método corrigido
    {
        $convenios = Convenio::all(); // Recupera todos os convênios
        return response()->json($convenios); // Retorna os dados como JSON
    }

    public function convenios($id)
    {
        $convenio = Convenio::find($id);
        if (!$convenio) {
            return response()->json(['message' => 'Convenio não encontrado'], 404);
        }
        return response()->json($convenio);
    }


    public function index()
    {

        $pacientes = Paciente::with('convenio')->get();
        $convenios = Convenio::all(); // Recupera todos os convênios
        return view('/Menu/pacientes', ['pacientes' => $pacientes, 'convenios' => $convenios]);
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
            'telefone_paci' => 'required|string|max:15',
            'email_paci' => 'required|email',

            'nome_cidade' => 'required|string|max:100',
            'fk_convenio_paci' => 'required|string',
            'data_obito_paci' => 'nullable|date', // campo opcional
            'cpf_paci' => 'required|string|max:14'
        ];




        // Se a idade for menor que 18 anos, adi   ciona as regras para o responsável
        if ($age < 18) {
            $rules['cpf_responsavel_paci'] = 'required|string|max:14';
            $rules['responsavel_paci'] = 'required|string|max:54';
        }

        // Cria um novo paciente e atribui os dados do request
        $paciente = new Paciente();
        $paciente->nome_paci = $request->nome_paci;
        $paciente->data_nasci_paci = $request->data_nasci_paci;
        $paciente->telefone_paci = $request->telefone_paci;
        $paciente->email_paci = $request->email_paci;
        $paciente->fk_convenio_paci = $request->fk_convenio_paci;
        $paciente->nome_cidade = $request->nome_cidade;
        $paciente->data_obito_paci = $request->data_obito_paci; // campo opcional
        $paciente->cpf_paci = $request->cpf_paci;

        // Se a idade for menor de 18 anos, salva os dados do responsável
        if ($age < 18) {
            $paciente->cpf_responsavel_paci = $request->cpf_responsavel_paci;
            $paciente->responsavel_paci = $request->responsavel_paci;
        }
        // Se o convênio for "Particular", não salva o campo carteira_convenio_paci
        if ($request->input('fk_convenio_paci') == 4) {
            $paciente->carteira_convenio_paci = null;
        } else {
            $paciente->carteira_convenio_paci = $request->carteira_convenio_paci;
        }
        // Aplica a validação com as regras definidas
        $request->validate($rules);

        // Salva o paciente no banco de dados
        $paciente->save();

        // Redireciona com uma mensagem de sucesso
        return redirect()->route('paciente.store')->with('success', 'Paciente cadastrado com sucesso!');
    }
}
