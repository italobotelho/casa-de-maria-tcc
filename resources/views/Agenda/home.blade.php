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
              <div class='fc-event-main'>Meu evento 1</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>Meu evento 2</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>Meu evento 3</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>Meu evento 4</div>
            </div>
            <div class='fc-event fc-h-event fc-daygrid-event fc-daygrid-block-event'>
              <div class='fc-event-main'>Meu evento 5</div>
            </div>
          </div>
    
          <p>
            <input type='checkbox' id='drop-remove' />
            <label for='drop-remove'>remove after drop</label>
          </p>
        </div>

        <div id='calendar-wrap'>
          <div id='calendar' 
          data-route-load-events="{{ route('routeLoadEvents') }}"
          data-route-event-update="{{ route('routeEventUpdate') }}">
        </div>

      </div>
      
    
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('assets/fullcalendar/dist/index.global.js') }}"></script>
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>  


<script src="{{ asset('assets/fullcalendar/packages/core/locales/pt-br.global.js') }}"></script>

{{-- cdn jquery --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

{{-- cdn moments --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

<script src="{{ asset('assets/fullcalendar/js/script.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/js/calendar.js') }}"></script>


@endsection
</body>
</html>
