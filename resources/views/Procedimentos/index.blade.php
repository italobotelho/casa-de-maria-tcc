@extends('Layout/configuracoes')

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

    <h1>Procedimentos</h1>

    <a href="{{ route('procedimentos.create') }}">Cadastrar</a>

    <ul>
      @foreach($procedimentos as $procedimento)
          <li>{{ $procedimento->nome_proc }} ({{ $procedimento->descricao_proc }})</li>
      @endforeach
  </ul>
@endsection