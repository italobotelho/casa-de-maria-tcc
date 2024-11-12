<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recado;
use App\Models\Procedimento;
use App\Models\Medico;

class RecadoController extends Controller
{
    public function index(Request $request)
    {
        // Verifica se o usuário quer visualizar recados excluídos
        $mostrarExcluidos = $request->query('mostrarExcluidos', false);
        
        // Ajusta a consulta para buscar os recados com base na flag de exclusão
        if ($mostrarExcluidos) {
            $recados = Recado::onlyTrashed()->paginate(5)->withQueryString(); // Recados excluídos
        } else {
            $recados = Recado::paginate(3)->withQueryString(); // Recados não excluídos
        }
    
        $procedimentos = Procedimento::where('status', 'ativo')->get();
        $medicos = Medico::all();
    
        return view('agenda.home', compact('recados', 'procedimentos', 'medicos', 'mostrarExcluidos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'texto' => 'required|string|max:200',
        ]);

        $recado = new Recado;
        $recado->texto = $request->input('texto');
        $recado->deleted_at = $request->has('somente_dia') ? now()->addDay() : null;
        $recado->save();

        return redirect()->route('agenda.home');
    }

    public function destroy($id)
    {
        $recado = Recado::findOrFail($id);
        $recado->delete();

        return redirect()->route('agenda.home');
    }
}
