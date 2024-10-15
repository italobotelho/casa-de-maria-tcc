{{-- resources/views/agenda/home.blade.php --}}
@extends('layouts.app')

@section('title', 'AGENDA') <!-- Define o título específico -->

@section('content')
<div class="container">
    <div id='calendar' data-route-load-events="{{ route('routeLoadEvents') }}"></div>
</div>
@endsection

@section('scripts')
<script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.15/index.global.min.js'></script>

<script src="{{ asset('js/fullcalendar/script.js') }}"></script>
<script src="{{ asset('js/fullcalendar/calendar.js') }}"></script>
@endsection