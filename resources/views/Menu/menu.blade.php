<<<<<<< HEAD
@extends('Layout/layout')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/menu.css')}}">
@endsection
  
@section('main')
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
=======
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="pt-br">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>
    <link href="{{ asset('/css/menu.css') }}" rel="stylesheet">
</head>
<body>
    <!--Navbar-->
    <nav>
        <div>
            <img class="navimg" src="/img/logo.png" alt="Logo Casa de Maria" width="35" height="45" >
            <img src="/img/titulo branco.png" alt="Casa de Maria" width="55" height="30">
           <a  href="conf"> <button><img src="/img/conf.png" alt="Configurações"></button> </a>
        </div>
    </nav>



    <!--Cards-->
   <div class="card-group">

     <div class="card">
     <a href="agenda">
            <img src="/img/agenda.png" alt="Ícone de agenda">
            <div class="card-body">
                <p class="card-text">AGENDA</p>
>>>>>>> tela-busca
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
