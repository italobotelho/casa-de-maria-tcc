@extends('Layout/layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/menu.css')}}">
@endsection

@section('main')
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-md-3">
                <div class="card rounded-4 shadow p-4 mx-auto">
                    <a href="agenda" class="link-offset-2 link-underline link-underline-opacity-0 mx-auto">
                        <img src="img/agenda.png" class="img-fluid" alt="Ícone de agenda">
                        <div class="card-body">
                            <p class="card-text fs-2">AGENDA</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 shadow p-4 mx-auto">
                    <a href="consulta" class="link-offset-2 link-underline link-underline-opacity-0 mx-auto">
                        <img src="img/consulta.png" class="img-fluid" alt="...">
                        <div class="card-body">
                            <p class="card-text fs-2">CONSULTA</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 shadow p-4 mx-auto">
                    <a href="pacientes" class="link-offset-2 link-underline link-underline-opacity-0 mx-auto">
                        <img src="img/paciente.png" class="img-fluid" alt="...">
                        <div class="card-body">
                            <p class="card-text fs-2">PACIENTES</p>
                        </div>
                    </a>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card rounded-4 shadow p-4 mx-auto">
                    <a href="profissional" class="link-offset-2 link-underline link-underline-opacity-0 mx-auto">
                        <img src="img/profissional.png" class="img-fluid" alt="...">
                        <div class="card-body">
                            <p class="card-text fs-2">MÉDICOS</p>
                        </div>
                    </a>
                </div>
            </div>
        </div>
@endsection
