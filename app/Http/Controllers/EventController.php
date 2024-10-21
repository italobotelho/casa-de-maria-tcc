<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Procedimento;
use App\Models\Convenio;
use App\Models\Medico;
use App\Models\Paciente;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function loadEvents()
    {
        $events = Event::with('procedimento')->get(); // Puxa os eventos com os procedimentos relacionados
        return response()->json($events);
    }

    public function index()
    {
        $procedimentos = Procedimento::all(); // Busca todos os procedimentos
        return view('agenda.home', compact('procedimentos')); // Passa para a view
    }

    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->color = $request->input('color');
        $event->procedimento_id = $request->input('procedimento_id');
    
        // Puxar o nome do procedimento da tabela procedimentos
        $procedimento = Procedimento::find($event->procedimento_id);
        $event->nome_proc = $procedimento ? $procedimento->nome_proc : null; // Adiciona o nome_proc
    
        $event->save();
        return response()->json(true);
    }
    
    public function update(EventRequest $request)
    {
        $event = Event::find($request->id);
    
        if ($event) {
            $event->title = $request->input('title');
            $event->start = $request->input('start');
            $event->end = $request->input('end');
            $event->color = $request->input('color');
            $event->procedimento_id = $request->input('procedimento_id');
    
            // Atualiza o nome_proc
            $procedimento = Procedimento::find($event->procedimento_id);
            $event->nome_proc = $procedimento ? $procedimento->nome_proc : null;
    
            $event->save();
            return response()->json(true);
        }
    
        return response()->json(['error' => 'Evento não encontrado'], 404);
    }

    public function destroy(Request $request){
        Event::where('id', $request->id)->delete();

        return response()->json(true);
    }

    public function getProcedimentos()
{
    $procedimentos = Procedimento::all();
    return response()->json($procedimentos);
}
}
