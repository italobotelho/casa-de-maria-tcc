{{-- resources/views/convenios/edit.blade.php --}}

@extends('Layout/configuracoes')
<link rel="stylesheet" href="{{ asset('css/conf.css') }}">
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
button{
      background-color:#EABF8A;
      border-radius: 13px;
      font-size:18px;
      font-weight: 200;
      border:2px;
      border-color:#653C11;
      margin:10px;
      color: white;
      padding:5px 10px; 
    }
</style>

<h2>Editar Convênio</h2>
<div class="modal-content">
<form action="{{ route('convenios.update', ['pk_id_conv' => $convenio->pk_id_conv]) }}" method="post">
    @csrf
    @method('PATCH')

    <div class="form-group">
        <label for="nome_conv">Nome do Convênio</label>
        <input type="text" id="nome_conv" name="nome_conv" class="form-control" value="{{ $convenio->nome_conv }}" required>
    </div>

    <div class="form-group">
        <label for="ans_conv">Registro ANS</label>
        <input type="text" id="ans_conv" name="ans_conv" class="form-control" value="{{ $convenio->ans_conv }}" required>
    </div>

    <button type="submit" >Atualizar Convênio</button>
</form>
</div>

@endsection