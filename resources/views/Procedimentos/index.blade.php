<!-- resources/views/procedimentos/index.blade.php -->
@extends('layouts.app-navbar-configuracoes')

@section('title', 'CONFIGURAÇÕES') <!-- Define o título específico -->

@section('sub-content')
    <h2>PROCEDIMENTOS</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ProcedimentoModal">
        Cadastrar Novo Convênio
        </button>

    @include('procedimentos.create')

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Descrição</th>
                <th scope="col">Duração Média</th>
                <th scope="col">Editar</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($procedimentos as $procedimento)
            <tr>
                <td>{{ $procedimento->nome_proc }}</td>
                <td>{{ $procedimento->descricao_proc }}</td>
                <td>...</td>
                <td>
                    <a href="#edit{{$procedimento->pk_cod_proc}}" data-bs-toggle="modal" class="btn btn-success">Editar</a>
                </td>
                <td>
                    <form action="{{ route('procedimentos.destroy', ['pk_cod_proc' => $convenio->pk_cod_proc]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
                @include('procedimentos.edit')
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
