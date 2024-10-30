<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Procedimento;
use App\Models\Convenio;
use App\Models\Medico;
use App\Models\Paciente;

use Illuminate\Http\Request;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Log;

class EventController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // No EventController


    public function loadEvents(Request $request)
    {
        $medicoId = $request->get('medico_id');
        $query = Event::with('procedimento');
    
        // Filtra eventos por médico, se um ID for fornecido
        if ($medicoId) {
            $query->where('medico', $medicoId);
        }
    
        $events = $query->get()->map(function ($event) {
            return [
                'id' => $event->id,
                'title' => $event->title,
                'start' => $event->start,
                'end' => $event->end,
                'procedimento_id' => $event->procedimento_id, // Certifique-se de que isso esteja presente
                'medico' => $event->medico,
                'convenio' => $event->convenio,
                'backgroundColor' => $event->color,
            ];
        });
    
        return response()->json($events);
    }
    
    public function index()
    {
        $procedimentos = Procedimento::all(); // Fetch all procedures
        $medicos = Medico::all(); // Fetch all doctors
       
        return view('agenda.home', compact('procedimentos', 'medicos')); // Pass to the view
    }
    
    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->color = $request->input('color');
        $event->procedimento_id = $request->input('procedimento_id');
        $event->convenio = $request->input('convenio');
        $event->medico = $request->input('medico'); // Certifique-se de que está pegando o campo correto
    
        // Verifique se o ID do médico não é nulo
        if (empty($event->medico)) {
            return response()->json(['error' => 'O campo médico é obrigatório.'], 400);
        }
    
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
            $event->medico = $request->input('medico'); // Use o ID do médico
    
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

    public function getConvenios()
    {
        // Busca todos os convênios no banco de dados
        $convenios = Convenio::all();

        // Retorna os convênios como JSON
        return response()->json($convenios);
    }
}
