{{-- resources/views/convenios/edit.blade.php --}}

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

<h2>Editar Convênio</h2>

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

    <button type="submit" class="btn btn-primary">Atualizar Convênio</button>
</form>

@endsection