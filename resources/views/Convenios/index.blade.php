{{-- resources/views/convenios/index.blade.php --}}

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
    <!-- resources/views/convenios/index.blade.php -->
    <a href="{{ route('convenios.create') }}">Cadastrar Novo Convenio</a>
    
    <h1>Convenios</h1>

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
                        <!-- Adicione links para editar e excluir os convenios -->
                        <a href="#">Editar</a>
                        <a href="#">Excluir</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection