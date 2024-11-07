{{-- resources/views/agenda/home.blade.php --}}
@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('assets/fullcalendar/css/calendar.css') }}">
@endsection

@section('title')
@stop

@section('content')
<div class="container">
    @include('agenda.modal-calendar')
    @include('agenda.modal-view-calendar')

    <div class="row align-items-center mb-3">
        <div class="col-md-6">
            <h1 class="display-4">AGENDA</h1> <!-- Exibindo o título diretamente -->
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label for="medicoSelect">Selecione o Profissional:</label>
                <select id="medicoSelect" class="form-control">
                    <option value="">Todos</option>
                    @foreach ($medicos as $medico)
                        <option value="{{ $medico->pk_crm_med }}">{{ $medico->nome_med }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>

    <div id='wrap'>
        <div style="flex: 4;">
            <!-- Calendário principal com visualização de horários -->
            <div id='calendar'
                data-route-load-events="{{ route('routeLoadEvents') }}"
                data-route-event-update="{{ route('routeEventUpdate') }}"
                data-route-event-store="{{ route('routeEventStore') }}"
                data-route-event-delete="{{ route('routeEventDelete') }}">
            </div>
        </div>

        <div id="calendarMonth">
            <!-- Calendário de visualização do mês -->
            <div id="calendarMonth"></div>
            <button class="btn btn-primary my-1">Buscar Agendamento</button>
            <button class="btn btn-primary my-1">Imprimir Agenda</button>
            <button class="btn btn-primary my-1">Exportar Agenda</button>
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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js" integrity="sha512-pHVGpX7F/27yZ0ISY+VVjyULApbDlD0/X0rgGbTqCE7WFW5MezNTWG/dnhtbBuICzsd0WQPgpE4REBLv+UqChw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

{{-- cdn moments --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment.min.js"></script>

<script src="{{ asset('assets/fullcalendar/js/script.js') }}"></script>
<script src="{{ asset('assets/fullcalendar/js/calendar.js') }}"></script>



@endsection