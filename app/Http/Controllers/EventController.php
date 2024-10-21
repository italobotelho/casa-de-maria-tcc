<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function loadEvents(){

        $events = Event::all();

        return response()->json($events);
    }

    public function store(EventRequest $request)
    {
        $event = new Event();
        $event->title = $request->input('title');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->color = $request->input('color');
        
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
            
            $event->save();
    
            return response()->json(true);
        }
    
        return response()->json(['error' => 'Evento não encontrado'], 404);
    }

    public function destroy(Request $request){
        Event::where('id', $request->id)->delete();

        return response()->json(true);
    }
}
