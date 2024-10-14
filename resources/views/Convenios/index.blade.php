{{-- resources/views/convenios/index.blade.php --}}

@extends('layouts.app-navbar-configuracoes')

@section('title', 'CONFIGURAÇÕES') <!-- Define o título específico -->

@section('sub-content')
    <a href="{{ route('convenios.create') }}">Cadastrar Novo Convenio</a>
    
    <h2>CONVÊNIOS</h2>

    <table>
        <thead>
            <tr>
                <th>Nome do Convenio</th>
                <th>ANS Convenio</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($convenios as $convenio)
            <tr>
                <td>{{ $convenio->nome_conv }}</td>
                <td>{{ $convenio->ans_conv }}</td>
                <td>
                    <a href="{{ route('convenios.edit', ['pk_id_conv' => $convenio->pk_id_conv]) }}">Editar</a>
                    <form action="{{ route('convenios.destroy', ['pk_id_conv' => $convenio->pk_id_conv]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Excluir</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection