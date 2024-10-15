<?php

// app/Http/Controllers/ProcedimentoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Procedimento;
use App\Models\Medico;

class ProcedimentoController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $procedimentos = Procedimento::all();
        $medicos = Medico::all(); 
        return view('procedimentos.index', compact('procedimentos', 'medicos')); // Return the view with the Procedimentos data
    }

    public function create()
    {
        $medicos = Medico::all(); // Busca todos os médicos
        return view('procedimentos.create', compact('medicos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome_proc' => 'required',
            'descricao_proc' => 'required',
            'tempo_proc' => 'required',
            'fk_crm_med' => 'required|exists:medicos,pk_crm_med',
        ]);
    
        $procedimento = new Procedimento();
        $procedimento->nome_proc = $request->input('nome_proc');
        $procedimento->descricao_proc = $request->input('descricao_proc');
        $procedimento->tempo_proc = $request->input('tempo_proc');
        $procedimento->fk_crm_med = $request->input('fk_crm_med');
        $procedimento->save();
    
        return redirect()->route('procedimentos.index')->with('success', 'Procedimento cadastrado com sucesso!');
    }

    public function edit($pk_cod_proc)
    {
        $procedimento = Procedimento::find($pk_cod_proc);
        $medicos = Medico::all(); // Busca todos os médicos
        return view('procedimentos.edit', compact('procedimento', 'medicos'));
    }
    
    public function update(Request $request, $pk_cod_proc)
    {
        $request->validate([
            'nome_proc' => 'required',
            'descricao_proc' => 'required',
            'tempo_proc' => 'required',
            'fk_crm_med' => 'required|exists:medicos,pk_crm_med',
        ]);
    
        $procedimento = Procedimento::find($pk_cod_proc);
        $procedimento->nome_proc = $request->input('nome_proc');
        $procedimento->descricao_proc = $request->input('descricao_proc');
        $procedimento->tempo_proc = $request->input('tempo_proc');
        $procedimento->fk_crm_med = $request->input('fk_crm_med');
        $procedimento->save();
    
        return redirect()->route('procedimentos.index');
    }

    public function destroy($pk_cod_proc)
    {
        $procedimento = Procedimento::find($pk_cod_proc);
        $procedimento->delete();
        return redirect()->route('procedimentos.index')->with('success', 'Procedimento excluído com sucesso!');
    }
}