{{-- resources/views/convenios/create.blade.php --}}

@extends('Layout/configuracoes')

@section('nav-convenios')
<li class="nav-item">
    <a class="nav-link " aria-current="page" href="gerais">Gerais</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" aria-current="page" href="procedimentos">Procedimentos</a>
  </li>
  <li class="nav-item">
    <a class="nav-link active" aria-current="page" href="convenios">Convênios</a>
  </li>
    
@endsection

@section('main-configuracoes')
    <h1>Cadastro de Convênio</h1>

    <form method="POST" action="{{ route('convenios.store') }}">
        @csrf

        <div class="form-group">
            <label for="nome_convenio">Nome do Convênio</label>
            <input type="text" id="nome_convenio" name="nome_convenio" class="form-control">
        </div>

        <div class="form-group">
            <label for="registro_ans">Registro ANS</label>
            <input type="text" id="registro_ans" name="registro_ans" class="form-control">
        </div>

        <div class="form-group">
            <label for="retorno_conv">Data de Retorno</label>
            <input type="date" id="retorno_conv" name="retorno_conv" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Convênio</button>
    </form>
@endsection