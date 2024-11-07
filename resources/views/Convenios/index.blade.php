{{-- resources/views/convenios/index.blade.php --}}

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
    .excluir {
        border: none;
        background-color: transparent;
    }

    .cad {
        font-size: 20px;
        position: relative;
        float: right;
        margin: 10px;
        padding: 15px;
    }

    /* Estilos para a tabela */
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th, td {
        font-size: 20px;
        padding: 12px;
        text-align: left;
    }

    th {
        background-color: #C99C65;
        color: white;
    }

    /* Linhas alternadas da tabela */
    tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    /* Alinhando botões lado a lado */
    .acoes {
        display: flex;
        gap: 8px; /* Espaço entre os botões */
    }
</style>
<br>
<a class="cad" type="button" href="{{ route('convenios.create') }}">Cadastrar Novo Convenio</a>

<h2>CONVÊNIOS</h2>
<div class="modal-content">
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
                <td class="acoes">
                    <a href="{{ route('convenios.edit', ['pk_id_conv' => $convenio->pk_id_conv]) }}">
                        <img src="img/edit.png" alt="Descrição da imagem">
                    </a>
                    <form action="{{ route('convenios.destroy', ['pk_id_conv' => $convenio->pk_id_conv]) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button class="excluir">
                            <img src="img/excluir.png" alt="Descrição da imagem">
                        </button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
