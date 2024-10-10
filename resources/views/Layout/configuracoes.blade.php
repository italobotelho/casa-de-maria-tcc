@extends('Layout/layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/app.css')}}">
@endsection

@section('main')
    <h1 class="fs-1 mt-4 mb-2">CONFIGURAÇÕES</h1>

    <div class="container border rounded-3">
        <ul class="nav nav-underline nav-fill justify-content-center">
            
                @yield('nav-gerais')

                @yield('nav-procedimentos')
            
                @yield('nav-convenios')
        
        </ul>

        @yield('main-configuracoes')
    </div>
@endsection
