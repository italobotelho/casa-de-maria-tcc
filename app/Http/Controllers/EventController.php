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
   
    public function show($id)
    {
        $event = Event::with(['procedimento', 'medico'])->find($id); // Carrega o evento, procedimento e médico associado
        if (!$event) {
            return response()->json(['message' => 'Evento não encontrado'], 404);
        }
    
        return response()->json([
            'id' => $event->id,
            'title' => $event->title,
            'start' => $event->start,
            'end' => $event->end,
            'procedimento_id' => $event->procedimento_id,
            'medico' => $event->medico ? $event->medico->nome_med : 'Médico não encontrado', // Acesse o nome do médico
            'convenio' => $event->convenio,
            'paciente_id' => $event->paciente_id,
        ]);
    }

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
                'paciente_id' => $event->paciente_id,
            ];
        });
    
        return response()->json($events);
    }

    public function getEvent($id)
    {
        try {
            $event = Event::with(['procedimento', 'medico'])->findOrFail($id); // Carrega o evento, procedimento e médico associado
            return response()->json($event);
        } catch (\Exception $e) {
            Log::error('Erro ao buscar evento: ' . $e->getMessage());
            return response()->json(['error' => 'Evento não encontrado.'], 404);
        }
    }
    
    public function updateColor(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:events,id',
            'color' => 'required',
        ]);

        $event = Event::find($request->id);
        $event->color = $request->color;
        $event->save();

        return response()->json(['message' => 'Cor atualizada com sucesso.']);
    }

    public function index()
    {
        $procedimentos = Procedimento::all(); // Fetch all procedures
        $medicos = Medico::all(); // Fetch all doctors
       
        return view('agenda.home', compact('procedimentos', 'medicos')); // Pass to the view
    }
    
    public function store(EventRequest $request)
    {
        Log::info('Dados recebidos:', $request->all());
        $event = new Event();
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->color = $request->input('color');
        $event->procedimento_id = $request->input('procedimento_id');
        $event->convenio = $request->input('convenio');
        $event->medico = $request->input('medico'); // Certifique-se de que está pegando o campo correto
        $event->paciente_id = $request->input('paciente_id');
    
        // Verifique se o ID do médico não é nulo
        if (empty($event->medico)) {
            return response()->json(['error' => 'O campo médico é obrigatório.'], 400);
        }

        // Verifique se o ID do paciente não é nulo
        if (empty($event->paciente_id)) {
            return response()->json(['error' => 'O campo paciente é obrigatório.'], 400);
        }
    
        $event->save();
        return response()->json(true);
    }
    
    public function update(EventRequest $request)
    {
        try {
            $event = Event::find($request->id);
        
            if ($event) {
                $event->title = $request->input('title');
                $event->start = $request->input('start');
                $event->end = $request->input('end');
                $event->color = $request->input('color');
                $event->procedimento_id = $request->input('procedimento_id');
                $event->medico = $request->input('medico'); // Certifique-se de que isso é um ID
                $event->paciente_id = $request->input('paciente_id');
        
                $event->save();
                return response()->json(true);
            }
        
            return response()->json(['error' => 'Evento não encontrado'], 404);
        } catch (\Exception $e) {
            Log::error('Erro ao atualizar evento: ' . $e->getMessage());
            Log::error('Dados recebidos para atualização: ', $request->all());
            return response()->json(['error' => 'Erro ao atualizar evento.'], 500);
        }
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
