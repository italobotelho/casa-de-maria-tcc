<?php

namespace App\Http\Controllers;

use App\Models\Medico;
use Illuminate\Http\Request;


class MedicoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    public function getMedico($id)
    {
  
        $medico = Medico::find($id);
    
        if (!$medico) {
            return response()->json(['message' => 'Médico não encontrado'], 404);
        }
        return response()->json([
            'nome_medico' => $medico->nome_med, // Corrigido para usar 'nome_med'
        ]);
    }

    
    public function buscarMedico(Request $request)
    {
        $query = $request->input('query');
        
        // Certifique-se de que a consulta não esteja vazia
        if (empty($query)) {
            return response()->json([]); // Retorna um array vazio se a consulta estiver vazia
        }
    
        // Tente buscar médicos
        try {
            $medicos = Medico::where('nome_med', 'LIKE', "%{$query}%")->get();
            return response()->json($medicos);
        } catch (\Exception $e) {
            
            return response()->json(['error' => 'Erro ao buscar médicos.'], 500);
        }
    }

    public function index()
    {
        $medicos = Medico::all();
        return view('medicos.index', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_med' => 'required|string|max:54',
            'telefone_med' => 'required|string|max:12',
            'uf_med' => 'required|string|max:18',
            'email_med' => 'required|email',
            'especialidade1_med' => 'required|string|max:40',
            'especialidade2_med' => 'required|string|max:40',
            'pk_crm_med' => 'required|integer'
        ], [
            'nome_med.required' => 'O campo nome é obrigatório',
            'telefone_med.required' => 'O campo telefone é obrigatório',
            'uf_med.required' => 'O campo UF é obrigatório',
            'email_med.required' => 'O campo email é obrigatório',
            'especialidade1_med.required' => 'O campo 1° especialidade é obrigatório',
            'especialidade2_med.required' => 'O campo 2° especialidade é obrigatório',
            'pk_crm_med.required' => 'O campo CRM é obrigatório'
        ]);

        $medico = new Medico();
        $medico->nome_med = $request->nome_med;
        $medico->telefone_med = $request->telefone_med;
        $medico->uf_med = $request->uf_med;
        $medico->email_med=$request->email_med;
        $medico->especialidade1_med=$request->especialidade1_med;
        $medico->especialidade2_med=$request->especialidade2_med;
        $medico->pk_crm_med=$request->pk_crm_med;

        $medico->save();

        return redirect()->route('medicos.store')->with('success', 'Medico cadastrado com sucesso!');
    }
}
