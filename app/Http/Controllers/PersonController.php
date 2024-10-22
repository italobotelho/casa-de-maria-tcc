<?php

namespace App\Http\Controllers; // Define o namespace do controlador
use Illuminate\Http\Request; 
use App\Models\Paciente; 
use App\Models\Convenio; 

class PersonController extends Controller
{
   
    public function __construct()
    {
        $this->middleware('auth'); // Aplica middleware de autenticação para proteger as rotas
    }

    // Método para buscar pacientes com base em uma consulta
    public function buscar(Request $request)
    {
        $query = $request->input('query'); // Obtém a consulta do request
        $pacientes = Paciente::where('nome_paci', 'like', '%' . $query . '%') // Filtra pacientes pelo nome
            ->select('pk_cod_paci', 'nome_paci', 'data_nasci_paci') // Seleciona campos específicos
            ->get(); // Obtém os resultados
        return response()->json($pacientes); // Retorna os pacientes em formato JSON
    }
        
    // Método para listar todos os pacientes e convênios
    public function index()
    {
        $pacientes = Paciente::with('convenio')->get(); // Recupera todos os pacientes com seus convênios associados
        $convenios = Convenio::all(); // Recupera todos os convênios
        return view('pacientes.pacientes', ['pacientes' => $pacientes, 'convenios' => $convenios]); // Retorna a view com os dados
    }

    // Método para atualizar os dados de um paciente
    public function update(Request $request)
    {
        // Validação dos dados recebidos
        $request->validate([
            'id' => 'required|exists:paciente,pk_cod_paci', // O ID deve existir
            'nome' => 'required|string|max:54', // Valida o nome
            'email' => 'required|email', // Valida o email
            'data_nasci' => 'required|date', // Valida a data de nascimento
            'telefone' => 'required|string|max:15', // Valida o telefone
            'cpf' => 'required|string|max:14', // Valida o CPF
            'cidade' => 'required|string|max:100', // Valida a cidade
            'responsavel' => 'string|max:54', // Valida o responsável (opcional)
            'cpf_responsavel' => 'string|max:14', // Valida o CPF do responsável (opcional)
            'fk_convenio_paci' => 'nullable|string' // Valida o convênio (opcional)
        ]);

        $paciente = Paciente::find($request->input('id')); // Busca o paciente pelo ID

        if ($paciente) { // Se o paciente existir
            // Atualiza os dados do paciente
            $paciente->nome_paci = $request->input('nome');
            $paciente->data_nasci_paci = $request->input('data_nasci');
            $paciente->telefone_paci = $request->input('telefone');
            $paciente->cpf_paci = $request->input('cpf');
            $paciente->nome_cidade = $request->input('cidade');
            $paciente->responsavel_paci = $request->input('responsavel');
            $paciente->cpf_responsavel_paci = $request->input('cpf_responsavel');
            $paciente->fk_convenio_paci = $request->input('fk_convenio_paci');

            if ($paciente->save()) { // Salva as alterações
                return response()->json(['success' => true, 'message' => 'Dados do paciente atualizados com sucesso!']);
            } else {
                return response()->json(['error' => 'Erro ao atualizar paciente'], 422); // Retorna erro em caso de falha
            }
        } else {
            return response()->json(['error' => 'Paciente não encontrado'], 404); // Retorna erro se o paciente não for encontrado
        }
    }

    // Método para listar todos os convênios
    public function ListarConvenio() 
    {
        $convenios = Convenio::all(); // Recupera todos os convênios
        return response()->json($convenios); // Retorna os convênios em formato JSON
    }

    // Método para obter um convênio específico pelo ID
    public function convenios($id)
    {
        $convenio = Convenio::find($id); // Busca o convênio pelo ID
        if (!$convenio) {
            return response()->json(['message' => 'Convenio não encontrado'], 404); // Retorna erro se não encontrado
        }
        return response()->json($convenio); // Retorna o convênio em formato JSON
    }

    // Método para armazenar um novo paciente
    public function store(Request $request)
    {
        // Calcula a idade com base na data de nascimento fornecida
        $birthDate = new \DateTime($request->input('data_nasci_paci'));
        $today = new \DateTime();
        $age = $today->diff($birthDate)->y; // Calcula a idade

        // Regras de validação básicas
        $rules = [
            'nome_paci' => 'required|string|max:54',
            'data_nasci_paci' => 'required|date',
            'telefone_paci' => 'required|string|max:15',
            'email_paci' => 'required|email',
            'nome_cidade' => 'required|string|max:100',
            'fk_convenio_paci' => 'required|string',
            'data_obito_paci' => 'nullable|date', // Campo opcional
            'cpf_paci' => 'required|string|max:14'
        ];

        // Se a idade for menor que 18 anos, adiciona as regras para o responsável
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
        $paciente->data_obito_paci = $request->data_obito_paci; // Campo opcional
        $paciente->cpf_paci = $request->cpf_paci;

        // Se a idade for menor de 18 anos, salva os dados do responsável
        if ($age < 18) {
            $paciente->cpf_responsavel_paci = $request->cpf_responsavel_paci;
            $paciente->responsavel_paci = $request->responsavel_paci;
        }

        // Se o convênio for "Particular", não salva o campo carteira_convenio_paci
        if ($request->input('fk_convenio_paci') == 4) {
            $paciente->carteira_convenio_paci = null; // Limpa o campo
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
