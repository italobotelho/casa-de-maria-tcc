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
<style>
    .modal-content {
    padding: 20px;
    background-color: white;
    border-radius: 5px;
    border: 1px solid #ddd;

}
</style>
    <h2>Cadastro de Convênio</h2>
<div class="modal-content">
    <form method="POST" action="{{ route('convenios.store') }}">
        @csrf

        <div class="form-group">
            <label for="nome_conv">Nome do Convênio</label>
            <input type="text" id="nome_conv" name="nome_conv" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="ans_conv">Registro ANS</label>
            <input type="text" maxlength="6" id="ans_conv" name="ans_conv" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-primary">Cadastrar Convênio</button>
    </form>
    </div>
@endsection