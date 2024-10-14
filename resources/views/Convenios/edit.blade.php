{{-- resources/views/convenios/edit.blade.php --}}

@extends('layouts.app-navbar-configuracoes')

@section('title', 'CONFIGURAÇÕES') <!-- Define o título específico -->

@section('sub-content')
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