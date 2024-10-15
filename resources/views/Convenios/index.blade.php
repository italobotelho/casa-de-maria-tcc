{{-- resources/views/convenios/index.blade.php --}}

@extends('layouts.app-navbar-configuracoes')

@section('title', 'CONFIGURAÇÕES') <!-- Define o título específico -->

@section('sub-content')

    <h2>CONVÊNIOS</h2>

    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ConvenioModal">
    Cadastrar Novo Convênio
    </button>

    @include('convenios.create')

    <table class="table table-bordered table-responsive">
        <thead>
            <tr>
                <th scope="col">Nome</th>
                <th scope="col">Registro ANS</th>
                <th scope="col">Editar</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($convenios as $convenio)
            <tr>
                <td>{{ $convenio->nome_conv }}</td>
                <td>{{ $convenio->ans_conv }}</td>
                <td>
                    <a href="#edit{{$convenio->pk_id_conv}}" data-bs-toggle="modal" class="btn btn-success">Editar</a>
                </td>
                <td>
                    <form action="{{ route('convenios.destroy', ['pk_id_conv' => $convenio->pk_id_conv]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
                @include('convenios.edit')
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection