@extends('Layout/configuracoes')
<link rel="stylesheet" href="{{ asset('css/conf.css')}}">
@section('nav-procedimentos')
<li class="nav-item">
    <a class="nav-link" aria-current="page" href="gerais">Gerais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="procedimentos">Procedimentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="convenios">Convênios</a>
  </li>
@endsection

@section('main-configuracoes')
<!-- resources/views/procedimentos/index.blade.php -->

<h2>PROCEDIMENTOS</h2>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Launch demo modal
</button>

<div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            @include('procedimentos.create', ['medicos' => $medicos])
        </div>
    </div>
</div>

<ul>
    @foreach($procedimentos as $procedimento)
        <li>{{ $procedimento->nome_proc }} ({{ $procedimento->descricao_proc }})
          <a href="{{ route('procedimentos.show', $procedimento->pk_cod_proc) }}">Ver detalhes</a>
        </li>
    @endforeach
</ul>
@endsection
