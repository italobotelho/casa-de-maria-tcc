@extends('Layout/layout')

@section('main-layout')
    <h1>Configurações</h1>


    <div class="container border">
        <ul class="nav nav-underline nav-fill justify-content-center">
            
                @yield('nav-gerais')

                @yield('nav-procedimentos')
            
                @yield('nav-convenios')
        
        </ul>

        @yield('main-configuracoes')

@endsection
