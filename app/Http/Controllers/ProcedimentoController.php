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
        return view('procedimentos.index', compact('procedimentos')); // Return the view with the Procedimentos data
    }
    
    public function create()
    {
        $medicos = Medico::all(); // Retrieve all médicos from the database
        return view('procedimentos.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nome_proc' => 'required|string|max:50',
            'descricao_proc' => 'required|string|max:100',
            'tempo_proc' => 'required|date_format:H:i:s', // Alterei o formato de tempo
            'fk_crm_med' => 'required|integer|exists:medico,pk_crm_med',
        ]);

        $procedimento = new Procedimento();
        $procedimento->nome_proc = $validatedData['nome_proc'];
        $procedimento->descricao_proc = $validatedData['descricao_proc'];
        $procedimento->tempo_proc = $validatedData['tempo_proc'];
        $procedimento->fk_crm_med = $validatedData['fk_crm_med'];
        $procedimento->save();

        return redirect()->route('procedimentos.index');
    }

    public function show($pk_cod_proc)
    {
        $procedimento = Procedimento::find($pk_cod_proc);
        if (!$procedimento) {
            abort(404); // or return a custom error message
        }
        return view('procedimentos.show', compact('procedimento'));
    }
}
    