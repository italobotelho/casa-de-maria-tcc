<?php

// app/Http/Controllers/ProcedimentoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedimento;
use App\Models\Medico;

class ProcedimentoController extends Controller
{

public function index()
{
    $procedimentos = Procedimento::all(); // Retrieve all Procedimentos from the database
    $medicos = Medico::all(); // Busca todos os médicos
    return view('procedimentos.index', ['procedimentos' => $procedimentos, 'medicos' => $medicos]); // Return the view with the Procedimentos data
}

    public function create()
    {
        $medicos = Medico::all(); // Busca todos os médicos
        return view('procedimentos.create', ['medicos' => $medicos]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_proc' => 'required|string|max:50',
            'descricao_proc' => 'required|string|max:100',
            'tempo_proc' => 'required|date_format:H:i',
            'fk_crm_med' => 'required|array|exists:medico,pk_crm_med',
        ]);
    
        $procedimento = new Procedimento();
        $procedimento->nome_proc = $validatedData['nome_proc'];
        $procedimento->descricao_proc = $validatedData['descricao_proc'];
        $procedimento->tempo_proc = $validatedData['tempo_proc'];
        
    
        $procedimento = Procedimento::create([
            'nome_proc' => $validatedData['nome_proc'],
            'descricao_proc' => $validatedData['descricao_proc'],
            'tempo_proc' => $validatedData['tempo_proc'],
        ]);
    
        $procedimento->medicos()->attach($validatedData['fk_crm_med']);

        return redirect()->route('procedimentos.index');
    }

    public function show($pk_cod_proc)
    {
        $procedimento = Procedimento::find($pk_cod_proc);
        if (!$procedimento) {
            abort(404); // or return a custom error message
        }
        $medicos = $procedimento->medicos;
        return view('procedimentos.show', ['procedimento' => $procedimento, 'medicos' => $medicos]);
    }
}
    