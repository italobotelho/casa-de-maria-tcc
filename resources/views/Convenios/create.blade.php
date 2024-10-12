{{-- resources/views/convenios/create.blade.php --}}

@extends('layouts.app-navbar-configuracoes')

@section('content')
    <h2>Cadastro de Convênio</h2>

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
@endsection