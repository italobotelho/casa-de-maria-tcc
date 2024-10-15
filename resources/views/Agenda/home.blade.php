{{-- resources/views/agenda/home.blade.php --}}
@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('assets/fullcalendar/css/calendar.css') }}">
@endsection 

@section('title', 'AGENDA') <!-- Define o título específico -->

@section('content')
<div class="container">
    <div id='wrap'>

        <div id='external-events'>
          <h4>Draggable Events</h4>
    
          <div id='external-events-list'>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>My Event 1</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>My Event 2</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>My Event 3</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>My Event 4</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>My Event 5</div>
            </div>
          </div>
    
          <p>
            <input type='checkbox' id='drop-remove' />
            <label for='drop-remove'>remove after drop</label>
          </p>
        </div>
    
        <div id='calendar-wrap'>
          <div id='calendar' data-route-load-events="{{ route('routeLoadEvents') }}"></div>
        </div>
    
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/fullcalendar/dist/index.global.js') }}"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>  

<script src="{{ asset('assets/fullcalendar/js/script.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/js/calendar.js') }}"></script>

<script src="{{ asset('assets/fullcalendar/packages/core/locales-all.js') }}"></script>
@endsection